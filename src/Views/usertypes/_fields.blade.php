@text('name'=>'slug','trans'=>'usertypes','options'=>['required' => 'required'])
@text('name'=>'name','trans'=>'usertypes','options'=>[])
@text('name'=>'label','trans'=>'usertypes','options'=>[])

@select('name'=>'role_id','trans'=>'usertypes','list'=>$roles,'options'=>[ 'required'=>'required'])

@text('name'=>'is_admin_only','trans'=>'usertypes','options'=>['required' => 'required'])
