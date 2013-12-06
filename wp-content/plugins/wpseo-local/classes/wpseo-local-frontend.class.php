<?php
if ( !class_exists( 'WPSEO_Frontend_Local' ) ) {

	class WPSEO_Frontend_Local {
		var $options = array();

		/**
		 * Constructor
		 */
		function __construct() {
			$this->options = get_option( "wpseo_local" );

			// Create shortcode functionality. Functions are defined in includes/wpseo-local-functions.php because they're also used by some widgets
			add_shortcode( 'wpseo_address', 'wpseo_local_show_address' );
			add_shortcode( 'wpseo_map', 'wpseo_local_show_map' );
			add_shortcode( 'wpseo_opening_hours', 'wpseo_local_show_opening_hours' );

			add_action( 'wpseo_opengraph', array( $this, 'opengraph_location' ) );
			add_filter( 'wpseo_opengraph_type', array( $this, 'opengraph_type' ) );

			if ( isset( $this->options['load_jquery'] ) && $this->options['load_jquery'] == '1' )
				add_action( 'wp_enqueue_scripts', array( &$this, 'load_scripts' ) );
		}

		/**
		 * Loads jQuery
		 *
		 * @since 0.1
		 */
		function load_scripts() {
			wp_enqueue_script( 'jquery' );
		}

		/**
		 * Output opengraph location tags
		 *
		 * @since 1.0
		 */
		function opengraph_location() {
			global $post;

			if ( $post->post_type == 'wpseo_locations' ) {
				$coords_lat  = get_post_meta( $post->ID, '_wpseo_coordinates_lat', true );
				$coords_long = get_post_meta( $post->ID, '_wpseo_coordinates_long', true );

				echo '<meta property="og:latitude" content="' . $coords_lat . '"/>' . "\n";
				echo '<meta property="og:longitude" content="' . $coords_long . '"/>' . "\n";
			}
		}

		/**
		 * Change the OpenGraph type when current post type is a location.
		 *
		 * @param $type string The OpenGraph type to be altered
		 * @return string
		 */
		function opengraph_type( $type ) {
			global $post;

			if ( $post->post_type == 'wpseo_locations' ) {
				$business_type = get_post_meta( $post->ID, '_wpseo_business_type', true );
				switch ( $business_type ) {
					case 'BarOrPub':
					case 'Winery':
						$type = 'bar';
						break;
					case 'Hotel':
					case 'Hostel':
						$type = 'hotel';
						break;
					case 'Restaurant':
						$type = 'restaurant';
						break;
					case 'GovernmentOffice':
						$type = 'government';
						break;
					default:
						$type = 'company';
						break;
				}
			}

			return $type;
		}

		/**
		 * Return the country name based on country code
		 *
		 * @since 0.1
		 *
		 * @param string $country_code Two char country code
		 *
		 * @return string Country name
		 */
		public function get_country( $country_code = '' ) {
			$countries = WPSEO_Frontend_Local::get_country_array();

			return $country_code != '' ? $countries[$country_code] : false;
		}

		public function get_country_array() {
			$countries = array(
				'AF' => 'Afghanistan', 'AL' => 'Albania', 'DZ' => 'Algeria', 'AS' => 'American Samoa', 'AD' => 'Andorra', 'AO' => 'Angola', 'AI' => 'Anguilla', 'AQ' => 'Antarctica', 'AG' => 'Antigua And Barbuda', 'AR' => 'Argentina', 'AM' => 'Armenia', 'AW' => 'Aruba', 'AU' => 'Australia', 'AT' => 'Austria', 'AZ' => 'Azerbaijan', 'BS' => 'Bahamas', 'BH' => 'Bahrain', 'BD' => 'Bangladesh', 'BB' => 'Barbados', 'BY' => 'Belarus', 'BE' => 'Belgium', 'BZ' => 'Belize', 'BJ' => 'Benin', 'BM' => 'Bermuda', 'BT' => 'Bhutan', 'BO' => 'Bolivia', 'BA' => 'Bosnia And Herzegovina', 'BW' => 'Botswana', 'BV' => 'Bouvet Island', 'BR' => 'Brazil', 'IO' => 'British Indian Ocean Territory', 'BN' => 'Brunei', 'BG' => 'Bulgaria', 'BF' => 'Burkina Faso', 'BI' => 'Burundi', 'KH' => 'Cambodia', 'CM' => 'Cameroon', 'CA' => 'Canada', 'CV' => 'Cape Verde', 'KY' => 'Cayman Islands', 'CF' => 'Central African Republic', 'TD' => 'Chad', 'CL' => 'Chile', 'CN' => 'China', 'CX' => 'Christmas Island', 'CC' => 'Cocos (Keeling) Islands', 'CO' => 'Columbia', 'KM' => 'Comoros', 'CG' => 'Congo', 'CK' => 'Cook Islands', 'CR' => 'Costa Rica', 'CI' => 'Cote D\'Ivorie (Ivory Coast)', 'HR' => 'Croatia (Hrvatska)', 'CU' => 'Cuba', 'CY' => 'Cyprus', 'CZ' => 'Czech Republic', 'CD' => 'Democratic Republic Of Congo (Zaire)', 'DK' => 'Denmark', 'DJ' => 'Djibouti', 'DM' => 'Dominica', 'DO' => 'Dominican Republic', 'TP' => 'East Timor', 'EC' => 'Ecuador', 'EG' => 'Egypt', 'SV' => 'El Salvador', 'GQ' => 'Equatorial Guinea', 'ER' => 'Eritrea', 'EE' => 'Estonia', 'ET' => 'Ethiopia', 'FK' => 'Falkland Islands (Malvinas)', 'FO' => 'Faroe Islands', 'FJ' => 'Fiji', 'FI' => 'Finland', 'FR' => 'France', 'FX' => 'France, Metropolitan', 'GF' => 'French Guinea', 'PF' => 'French Polynesia', 'TF' => 'French Southern Territories', 'GA' => 'Gabon', 'GM' => 'Gambia', 'GE' => 'Georgia', 'DE' => 'Germany', 'GH' => 'Ghana', 'GI' => 'Gibraltar', 'GR' => 'Greece', 'GL' => 'Greenland', 'GD' => 'Grenada', 'GP' => 'Guadeloupe', 'GU' => 'Guam', 'GT' => 'Guatemala', 'GN' => 'Guinea', 'GW' => 'Guinea-Bissau', 'GY' => 'Guyana', 'HT' => 'Haiti', 'HM' => 'Heard And McDonald Islands', 'HN' => 'Honduras', 'HK' => 'Hong Kong', 'HU' => 'Hungary', 'IS' => 'Iceland', 'IN' => 'India', 'ID' => 'Indonesia', 'IR' => 'Iran', 'IQ' => 'Iraq', 'IE' => 'Ireland', 'IL' => 'Israel', 'IT' => 'Italy', 'JM' => 'Jamaica', 'JP' => 'Japan', 'JO' => 'Jordan', 'KZ' => 'Kazakhstan', 'KE' => 'Kenya', 'KI' => 'Kiribati', 'KW' => 'Kuwait', 'KG' => 'Kyrgyzstan', 'LA' => 'Laos', 'LV' => 'Latvia', 'LB' => 'Lebanon', 'LS' => 'Lesotho', 'LR' => 'Liberia', 'LY' => 'Libya', 'LI' => 'Liechtenstein', 'LT' => 'Lithuania', 'LU' => 'Luxembourg', 'MO' => 'Macau', 'MK' => 'Macedonia', 'MG' => 'Madagascar', 'MW' => 'Malawi', 'MY' => 'Malaysia', 'MV' => 'Maldives', 'ML' => 'Mali', 'MT' => 'Malta', 'MH' => 'Marshall Islands', 'MQ' => 'Martinique', 'MR' => 'Mauritania', 'MU' => 'Mauritius', 'YT' => 'Mayotte', 'MX' => 'Mexico', 'FM' => 'Micronesia', 'MD' => 'Moldova', 'MC' => 'Monaco', 'MN' => 'Mongolia', 'MS' => 'Montserrat', 'MA' => 'Morocco', 'MZ' => 'Mozambique', 'MM' => 'Myanmar (Burma)', 'NA' => 'Namibia', 'NR' => 'Nauru', 'NP' => 'Nepal', 'NL' => 'Netherlands', 'AN' => 'Netherlands Antilles', 'NC' => 'New Caledonia', 'NZ' => 'New Zealand', 'NI' => 'Nicaragua', 'NE' => 'Niger', 'NG' => 'Nigeria', 'NU' => 'Niue', 'NF' => 'Norfolk Island', 'KP' => 'North Korea', 'MP' => 'Northern Mariana Islands', 'NO' => 'Norway', 'OM' => 'Oman', 'PK' => 'Pakistan', 'PW' => 'Palau', 'PA' => 'Panama', 'PG' => 'Papua New Guinea', 'PY' => 'Paraguay', 'PE' => 'Peru', 'PH' => 'Philippines', 'PN' => 'Pitcairn', 'PL' => 'Poland', 'PT' => 'Portugal', 'PR' => 'Puerto Rico', 'QA' => 'Qatar', 'RE' => 'Reunion', 'RO' => 'Romania', 'RU' => 'Russia', 'RW' => 'Rwanda', 'SH' => 'Saint Helena', 'KN' => 'Saint Kitts And Nevis', 'LC' => 'Saint Lucia', 'PM' => 'Saint Pierre And Miquelon', 'VC' => 'Saint Vincent And The Grenadines', 'SM' => 'San Marino', 'ST' => 'Sao Tome And Principe', 'SA' => 'Saudi Arabia', 'SN' => 'Senegal', 'SC' => 'Seychelles', 'SL' => 'Sierra Leone', 'SG' => 'Singapore', 'SK' => 'Slovak Republic', 'SI' => 'Slovenia', 'SB' => 'Solomon Islands', 'SO' => 'Somalia', 'ZA' => 'South Africa', 'GS' => 'South Georgia And South Sandwich Islands', 'KR' => 'South Korea', 'ES' => 'Spain', 'LK' => 'Sri Lanka', 'SD' => 'Sudan', 'SR' => 'Suriname', 'SJ' => 'Svalbard And Jan Mayen', 'SZ' => 'Swaziland', 'SE' => 'Sweden', 'CH' => 'Switzerland', 'SY' => 'Syria', 'TW' => 'Taiwan', 'TJ' => 'Tajikistan', 'TZ' => 'Tanzania', 'TH' => 'Thailand', 'TG' => 'Togo', 'TK' => 'Tokelau', 'TO' => 'Tonga', 'TT' => 'Trinidad And Tobago', 'TN' => 'Tunisia', 'TR' => 'Turkey', 'TM' => 'Turkmenistan', 'TC' => 'Turks And Caicos Islands', 'TV' => 'Tuvalu', 'UG' => 'Uganda', 'UA' => 'Ukraine', 'AE' => 'United Arab Emirates', 'UK' => 'United Kingdom', 'US' => 'United States', 'UM' => 'United States Minor Outlying Islands', 'UY' => 'Uruguay', 'UZ' => 'Uzbekistan', 'VU' => 'Vanuatu', 'VA' => 'Vatican City (Holy See)', 'VE' => 'Venezuela', 'VN' => 'Vietnam', 'VG' => 'Virgin Islands (British)', 'VI' => 'Virgin Islands (US)', 'WF' => 'Wallis And Futuna Islands', 'EH' => 'Western Sahara', 'WS' => 'Western Samoa', 'YE' => 'Yemen', 'YU' => 'Yugoslavia', 'ZM' => 'Zambia', 'ZW' => 'Zimbabwe'
			);

			return $countries;
		}
	}
}
