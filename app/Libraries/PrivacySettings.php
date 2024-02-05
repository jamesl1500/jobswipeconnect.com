<?php
namespace App\Libraries;

class PrivacySettings
{
    protected $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function returnAllPrivacySettings($uid = null)
    {
        if ($uid) {
            return \App\Models\PrivacySettings::where('user_id', $uid)->first();
        }
        return \App\Models\PrivacySettings::where('user_id', auth()->user()->id)->first();
    }
}
