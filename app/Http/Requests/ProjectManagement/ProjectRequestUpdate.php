<?php

namespace App\Http\Requests\ProjectManagement;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequestUpdate extends FormRequest
{


    private $patternPhone = "/^\+?\d{8,14}$/";
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'designer_id' => 'nullable|exists:users,id',
            'designer_deadline_days' => 'nullable|integer|between:0,100',
            'designer_deadline_hours' => 'nullable|integer|between:0,24',
            'marketer_id' => 'nullable|exists:users,id',
            'marketer_deadline_days' => 'nullable|integer|between:0,100',
            'marketer_deadline_hours' => 'nullable|integer|between:0,24',
            'advertiser_id' => 'nullable|exists:users,id',
            'advertiser_deadline_days' => 'nullable|integer|between:0,100',
            'advertiser_deadline_hours' => 'nullable|integer|between:0,24',

            'platforms' => 'required|array',
            'platforms.*.platform_id' => 'required|exists:platforms,id',
            'platforms.*.auth.username' => 'nullable|string|max:50',
            'platforms.*.auth.password' => 'nullable|string|max:50',
            'platforms.*.url' => 'nullable|required_if:platforms.*.need_platform,0|url|max:180',
            'platforms.*.need_platform' => 'required|boolean',
            'platforms.*.need_name' => 'nullable|required_if:platforms.*.need_platform,1|string|max:50',

            'phone_numbers' => 'nullable|array',
            'phone_numbers.*.number' => 'required|regex:' . $this->patternPhone,
            'addresses' => 'nullable|array',
            'addresses.*.address' => 'required|string|between:2,180',
            'websites' => 'nullable|array',
            'websites.*.url' => 'required|url|max:180',
            'emails' => 'nullable|array',
            'emails.*.email' => 'required|email|max:50',


            'designs_count' => 'nullable|integer|max:100',
            'need_logo' => 'nullable|boolean',
            'logo_src' => 'nullable|string',
            'need_cover' => 'required|boolean',
            'need_profile' => 'required|boolean',
            'colors_favorite' => 'nullable|array',
            'colors_favorite.*.color' => 'required|string',
            'design_info' => 'nullable|string|max:10000',
            'gallery' => 'nullable|array',


            'posts_count' => 'nullable|integer|between:1,150',
            'posts_type.single' => 'nullable|integer|between:1,50',
            'posts_type.grouped' => 'nullable|integer|between:1,50',
            'posts_type.cover_post' => 'nullable|integer|between:1,50',
            'client_products' => 'nullable|string|max:10000',
            'client_offers' => 'nullable|string|max:10000',
            'competitors_links' => 'nullable|array',
            'competitors_links.*.url' => 'required|url|max:180',
            'competitors_links.*.note' => 'nullable|string|max:500',


            'sponsored_posts_count' => 'nullable|integer|between:1,150',
            'targeted_places' => 'nullable|array',
            'targeted_places.*.place' => 'required|string|max:50',
            'targeted_gender.male' => 'required|boolean',
            'targeted_gender.female' => 'required|boolean',
            'targeted_age.min' => 'required|integer|between:13,65',
            'targeted_age.max' => 'required|integer|between:13,65',
            'days_count' => 'nullable|integer|between:1,100',
            'day_budget' => 'nullable|integer|max:5000',

            'note' => 'nullable|string|max:5000',
        ];
    }
}
