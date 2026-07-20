<?php

namespace App\Libraries;

use App\Models\PrivacySettings as PrivacySettingsModel;
use App\Models\User;

class PrivacySettings
{
    protected ?User $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function returnAllPrivacySettings(?int $uid = null): ?PrivacySettingsModel
    {
        if ($uid) {
            return PrivacySettingsModel::where('user_id', $uid)->first();
        }

        return PrivacySettingsModel::where('user_id', auth()->user()->id)->first();
    }
}
