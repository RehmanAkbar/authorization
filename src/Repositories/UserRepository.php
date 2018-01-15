<?php
/**
 * Created by PhpStorm.
 * User: fakhar
 * Date: 13/12/2016
 * Time: 3:28 PM
 */

namespace Softpyramid\Authorization\Repositories;


use Softpyramid\Authorization\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Image;

class UserRepository extends Repository
{

    public function model()
    {
       return User::class;
    }

    public function createUser($request){

        $user_data = $request->except('_token');

        $user_data['password'] = Hash::make($user_data['password']);

        $user = $this->model->create($user_data);

        if($request->hasFile('image')) {

            $this->uploadUserImage($user);
        }


        return $user;
    }

    public function updateUser($id,$request){

        $user_data = $request->except('_token');

        $user = $this->model->find($id);

        if($request->hasFile('image')) {


            $image = $this->uploadUserImage($user);

        }

        $user->update($user_data);

        if(isset($user_data['roles'])){
            $user->roles()->sync($user_data['roles']);
        }

        return $user;
    }

    public function uploadUserImage($user)
    {
        $image        = request()->file('image');
        $imagePath    = md5($user->id) . "-" . time().'.'.$image->getClientOriginalExtension();
        $originalName = $image->getClientOriginalName();

        $userImage    = Image::make($image)->resize(820, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        Storage::cloud('google')->put($imagePath, $userImage->stream()->detach());

        $dir = '/';
        $recursive = false; // Get subdirectories also?
        $contents = collect(Storage::cloud()->listContents($dir, $recursive));

        $file = $contents
            ->where('type', '=', 'file')
            ->where('filename', '=', pathinfo($imagePath, PATHINFO_FILENAME))
            ->where('extension', '=', pathinfo($imagePath, PATHINFO_EXTENSION))
            ->first();

        $upload = $user->uploads()->create([
            'original_name' => $originalName,
            'path' => $file['path'],
            'media_type' => 'image',
            'uploaded_by_user_id' => $user->id,
        ]);

//        return ['name' => $originalName , 'path' => $imagePath];

    }

    public function updateUserPassword($password) {
        $user = auth()->user();
        $user->password = bcrypt($password);
        return $user->save();
    }

}