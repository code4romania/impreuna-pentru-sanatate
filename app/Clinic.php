<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Class Clinic
 * @package App
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property string|null $description_en
 * @property string|null $additional_information
 * @property string|null $additional_information_en
 * @property string|null $transport_details
 * @property string|null $transport_details_en
 * @property int $country_id
 * @property string $city
 * @property string|null $address
 * @property int|null $phone_country_id
 * @property string|null $phone_number
 * @property string|null $website
 * @property string|null $office_email
 * @property string|null $contact_person_name
 * @property string|null $contact_person_name_en
 * @property int|null $contact_phone_country_id
 * @property string|null $contact_person_phone
 * @property string|null $contact_person_email
 * @property DateTime|null $created_at
 * @property DateTime|null $updated_at
 * @property DateTime|null $deleted_at
 */
class Clinic extends Model implements Auditable
{
    use SoftDeletes, HasSlug, Searchable;
    use \OwenIt\Auditing\Auditable;

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return BelongsToMany
     */
    public function specialities()
    {
        return $this->belongsToMany(Speciality::class);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'additional_information' => $this->additional_information
        ];
    }

    public function phoneCountry()
    {
        return $this->belongsTo(Country::class, 'phone_country_id', 'id');
    }

    public function contactPhoneCountry()
    {
        return $this->belongsTo(Country::class, 'contact_phone_country_id', 'id');
    }
}
