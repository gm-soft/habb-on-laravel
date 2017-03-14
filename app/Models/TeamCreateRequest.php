<?php

namespace App\Models;;

use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelArdent\Ardent\Ardent;
use Carbon\Carbon;

/**
 * Class TeamCreateRequest
 * @package App\Models
 *
 * @property string name
 * @property string city
 * @property string requester_name
 * @property string requester_phone
 * @property string requester_email
 * @property string requester_comment
 * @property array participant_ids
 * @property array participant_names
 * @property array participant_roles
 * @property bool request_processed
 * @property bool team_created
 * @property string team_id
 * @property string comment
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 */
class TeamCreateRequest extends Ardent
{
    use SoftDeletes;
    protected $table = "team_create_requests";
    protected $dates = [
        'deleted_at'
    ];
    protected $casts = [
        'participant_ids' => 'array',
        'participant_names' => 'array',
        'participant_roles' => 'array'
    ];

    public static $rules = [
        'name' => 'between:1,100'
    ];

    public function getParticipantIdsAsString() {
        return join(', ', $this->participant_ids);
    }

    public function getParticipantNamesAsString() {
        return join(', ', $this->participant_names);
    }

    public function getParticipantRolesAsString() {
        return join(', ', $this->participant_roles);
    }

    #region Attributes
    public function getParticipantIdsAttribute($value){
        $result = explode(',', $value);
        return $result;
    }

    public function setParticipantIdsAttribute($value) {
        $this->attributes['participant_ids']= join(',', $value);
    }

    public function getParticipantNamesAttribute($value){
        $result = explode(',', $value);
        return $result;
    }

    public function setParticipantNamesAttribute($value) {
        $this->attributes['participant_names']= join(',', $value);
    }

    public function getParticipantRolesAttribute($value){
        $result = explode(',', $value);
        return $result;
    }

    public function setParticipantRolesAttribute($value) {
        $this->attributes['participant_roles']= join(',', $value);
    }

    #endregion


}
