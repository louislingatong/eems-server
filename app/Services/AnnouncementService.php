<?php

namespace App\Services;

use App\Announcement;
use App\Employee;
use App\Image;
use App\Mail\AnnouncementMail;
use App\TransientImage;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AnnouncementService
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
    }

    /**
     * Add new announcement.
     *
     * @param mixed $data
     * @return Announcement
     * @throws \Exception
     */
    public function add($data)
    {
        DB::beginTransaction();

        try {
            // set announcement owner to data array
            $data['owner_id'] = Auth::id();
            // create new announcement
            $announcement = Announcement::create($data);

            // check if recipients is array and retrieve employee by email
            if (is_array($data['recipients'])) {
                $employees = Employee::with('user')->get()->whereIn('user.email', $data['recipients']);
            } else {
                $employees = Employee::with('user')->get()->where('user.email', $data['recipients']);
            }
            // attach users as announcement recipients
            $announcement->recipients()->attach($employees);
            // get announcement images by source
            $images = $this->getImagesBySource($data['body']);
            // check if announcement has images
            if (count($images)) {
                // save all announcement images
                $announcement->images()->saveMany($images);
            }
            // initialize email details
            $details = [
                'subject' => $announcement->subject,
                'body' => $announcement->body
            ];
            // send announcement
            Mail::to($data['recipients'])->send(new AnnouncementMail($details));

            DB::commit();

            return $announcement;
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }
    }

    /**
     * Add new transient image.
     *
     * @param  mixed $data
     * @return Response
     */
    public function addTransientImage($data)
    {
        // initialize path url
        $path = $data->file('image')->store(config('constants.storage.announcements'), config('constants.storage.public'));
        // initialize new transient image
        $transientImage = new TransientImage();
        // set transient image path
        $transientImage['path'] = $path;
        // save transient image
        $transientImage->save();

        return response()->json([
            'path' => config('constants.fileUrl') . $transientImage->path
        ], 200);
    }

    /**
     * Get image source.
     *
     * @param  string $data
     * @return Collection
     */
    private function getImagesBySource($data)
    {
        // get all image source
        preg_match_all('/src=".*\/storage\/([^"]+)"/', $data, $match);

        $newArray = [];

        foreach (array_pop($match) as $path) {
            $image = new Image();
            $image->path = $path;
            array_push($newArray, $image);
        }

        return $newArray;
    }
}