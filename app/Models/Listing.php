<?php
    namespace App\Models;

    class Listing {
        public static function all() {
            return [
                [  'id' => 1,
                'title' => 'Listing One',
                'description' => '
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent facilisis tellus sed justo tempus, nec ornare elit blandit. Maecenas volutpat dui in sagittis interdum. Ut ut ex odio. Suspendisse egestas est vel eros pharetra, nec rhoncus nunc luctus. Quisque interdum massa non orci aliquet, a fringilla purus dignissim'
              ],
              [
                'id' => 2,
                'title' => 'Listing Two',
                'description' => '
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent facilisis tellus sed justo tempus, nec ornare elit blandit. Maecenas volutpat dui in sagittis interdum. Ut ut ex odio. Suspendisse egestas est vel eros pharetra, nec rhoncus nunc luctus. Quisque interdum massa non orci aliquet, a fringilla purus dignissim'
              ]
              ];
        }

        public static function find($id) {
            $listings = self::all();

            foreach ($listings as $listing) {
                if($listing['id'] == $id) {
                    return $listing;
                }
            }
        }

    }