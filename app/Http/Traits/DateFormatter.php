<?php

namespace App\Http\Traits;


use DateTimeInterface;

/**
 * use for failed validation
 */
trait DateFormatter
{

   /**
    * Prepare a date for array / JSON serialization.
    *
    * @param  \DateTimeInterface  $date
    * @return string
    */
   protected function serializeDate(DateTimeInterface $date)
   {
      return $date->format('Y-m-d H:i:s');
   }
}
