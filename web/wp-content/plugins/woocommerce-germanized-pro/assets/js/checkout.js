window.germanized = window.germanized || {};

( function( $, germanized ) {

    germanized.pro_checkout = {
        params: {},

        init: function() {
            this.params = wc_gzdp_checkout_params;

            $( document )
                .on( 'change', '#billing_vat_id, #shipping_vat_id', this.onChangeVatID )
                .on( 'change', '#billing_company, #shipping_company', this.onChangeCompany )
                .on( 'change', '#ship-to-different-address-checkbox', this.onChangeShipToDifferentAddress )
                .on( 'change', '#billing_postcode, #shipping_postcode', this.onChangePostcode );

            $( document.body )
                .on( 'updated_checkout', this.onUpdatedCheckout )
                .on( 'checkout_error', this.onUpdatedCheckout )
                .on( 'country_to_state_changing', this.onCountryToStateChange );

            if ( this.params.refresh_vat_id_status ) {
                $( document.body ).on( 'updated_checkout', this.refreshRequiredStatus );
            }

            this.showOrHideVatIdField();
        },

        refreshRequiredStatus: function() {
            var self = germanized.pro_checkout;

            var params = {
                'security': self.params.vat_id_status_refresh_nonce,
                'action'  : 'woocommerce_gzdp_vat_id_status_refresh'
            };

            var $vatField = $( '.woocommerce-checkout' ).find( '#billing_vat_id:visible, #shipping_vat_id:visible' ).parents( '.form-row' );

            if ( $vatField.length ) {
                $.ajax({
                    type: "POST",
                    url:  self.params.ajax_url,
                    data: params,
                    success: function( data ) {
                        $vatField = $( '.woocommerce-checkout' ).find( '#billing_vat_id:visible, #shipping_vat_id:visible' ).parents( '.form-row' );

                        if ( $vatField.length > 0 ) {
                            if ( data.vat_id_required ) {
                                if ( $vatField.find( 'label .optional' ).length ) {
                                    $vatField.find( 'label .optional' ).hide();
                                }

                                if ( ! $vatField.find( 'label .required' ).length ) {
                                    $added = $vatField.find( 'label' ).append( '&nbsp;<abbr class="required" title="' + self.params.i18n_vat_id_label_required + '">*</abbr>' );
                                }

                                $vatField.find( 'label .required' ).show();
                            } else {
                                if ( $vatField.find( 'label .required' ).length ) {
                                    $vatField.find( 'label .required' ).hide();
                                }

                                if ( ! $vatField.find( 'label .optional' ).length ) {
                                    $vatField.find( 'label' ).append( '&nbsp;<span class="optional">(' + self.params.i18n_vat_id_label_optional + ')</span>' );
                                }

                                $vatField.find( 'label .optional' ).show();
                            }
                        }
                    },
                    dataType: 'json'
                });
            }
        },

        onCountryToStateChange: function( event, country, wrapper ) {
            var self = germanized.pro_checkout;

            self.showOrHideVatIdField( wrapper );
        },

        getVatExemptPostcodesByCountry: function( country ) {
            var self = germanized.pro_checkout,
                postcodes = [];

            country = country.toString().toUpperCase();

            if ( self.params.vat_exempt_postcodes.hasOwnProperty( country ) ) {
                return self.params.vat_exempt_postcodes[ country ];
            }

            return postcodes;
        },

        onChangePostcode: function() {
            var self     = germanized.pro_checkout,
                $wrapper = $( this ).parents( '.woocommerce-billing-fields, .woocommerce-shipping-fields' );

            self.showOrHideVatIdField( $wrapper );
        },

        onUpdatedCheckout: function() {
            var $wrapper    = $( '.woocommerce-billing-fields, .woocommerce-shipping-fields' ),
                $field      = $wrapper.find( '#billing_vat_id:visible, #shipping_vat_id:visible' ),
                $errors     = $( '.woocommerce-error' ),
                hasVatError = false;

            if ( $errors.length > 0 ) {
                var $vatIdError = $errors.find( '[data-id$="vat_id"]' );

                if ( $vatIdError.length > 0 ) {
                    var fieldId = $vatIdError.data( 'id' );
                    $field      = $wrapper.find( '#' + fieldId );
                    hasVatError = true;
                }
            }

            if ( $field.length > 0 && $field.is( ':input' ) ) {
                var $parent = $field.closest( '.form-row' );

                $parent.removeClass( 'woocommerce-validated woocommerce-invalid' );

                if ( hasVatError ) {
                    $parent.addClass( 'woocommerce-invalid' );
                } else {
                    $parent.addClass( 'woocommerce-validated' );
                }
            }
        },

        validateField: function( $field ) {
            var self = germanized.pro_checkout;

            if ( $field.length > 0 && $field.is( ':input' ) ) {
                var vatId   = $field.val(),
                    $parent = $field.closest( '.form-row' );

                if ( vatId.length > 0 ) {
                    if ( self.validateId( vatId ) ) {
                        $parent.removeClass( 'woocommerce-invalid' );
                    } else {
                        $parent.removeClass( 'woocommerce-validated' );
                    }
                }
            }
        },

        validateId: function( vatId ) {
            return /^(CHE[0-9]{9}|ATU[0-9]{8}|IX([0-9]{9}|[0-9]{12})|BE[01][0-9]{9}|BG[0-9]{9,10}|HR[0-9]{11}|CY[A-Z0-9]{9}|CZ[0-9]{8,10}|DK[0-9]{8}|EE[0-9]{9}|FI[0-9]{8}|FR[0-9A-Z]{2}[0-9]{9}|DE[0-9]{9}|EL[0-9]{9}|HU[0-9]{8}|IE([0-9]{7}[A-Z]{1,2}|[0-9][A-Z][0-9]{5}[A-Z])|IT[0-9]{11}|LV[0-9]{11}|LT([0-9]{9}|[0-9]{12})|LU[0-9]{8}|MT[0-9]{8}|NL[0-9]{9}B[0-9]{2}|PL[0-9]{10}|PT[0-9]{9}|RO[0-9]{2,10}|SK[0-9]{10}|SI[0-9]{8}|ES[A-Z]([0-9]{8}|[0-9]{7}[A-Z])|SE[0-9]{12}|GB([0-9]{9}|[0-9]{12}|GD[0-4][0-9]{2}|HA[5-9][0-9]{2}))$/.test( vatId );
        },

        onChangeVatID: function() {
            var self   = germanized.pro_checkout,
                $field = $( this );

            $( '.woocommerce-error, .woocommerce-message' ).each( function() {
                /**
                 * Do not removes login, coupon toggle messages
                 */
                if ( $( this ).parents( '.woocommerce-form-login-toggle, .woocommerce-form-coupon-toggle' ).length <= 0 ) {
                    $( this ).remove();
                }
            } );

            self.validateField( $field );

            $( 'body' ).trigger( 'update_checkout' );
        },

        onChangeCompany: function() {
            $( 'body' ).trigger( 'update_checkout' );
        },

        onChangeShipToDifferentAddress: function() {
            var self = germanized.pro_checkout;

            self.showOrHideVatIdField();
        },

        showOrHideVatIdField: function( $wrapper ) {
            $wrapper = ( typeof $wrapper === 'undefined' ) ? $( '.woocommerce-billing-fields' ) : $wrapper;

            var self                = germanized.pro_checkout,
                $countryField       = $wrapper.find( '#billing_country, #shipping_country' ),
                $checkbox           = $( '#ship-to-different-address-checkbox' ),
                $billingWrapper     = $wrapper.hasClass( 'woocommerce-billing-fields' ) ? $wrapper : $( '.woocommerce-billing-fields' ),
                $billing_vat_id     = $billingWrapper.find( '#billing_vat_id' ),
                relevantAddressType = 'billing';

            /**
             * Let's check which field is relevant first (billing or shipping VAT ID).
             */
            if ( self.params.supports_shipping_vat_id ) {
                if ( $checkbox.is( ':checked' ) ) {
                    // Backup real value
                    $billing_vat_id.data( 'field-value', $billing_vat_id.val() );

                    // Use placeholder value to make sure billing vat id won't throw empty errors
                    $billing_vat_id.val( '' ).parents( '.form-row' ).hide();

                    relevantAddressType = 'shipping';

                    self.onChangeVatID();
                } else {
                    if ( ! $billing_vat_id.val() || $billing_vat_id.val() === '1' ) {
                        var oldVal = $billing_vat_id.data( 'field-value' );

                        $billing_vat_id.val( oldVal );
                    }

                    $billing_vat_id.parents( '.form-row' ).hide();

                    $( document.body ).off( 'country_to_state_changing', self.onCountryToStateChange );
                    $( document.body ).trigger( 'country_to_state_changing', [ $billingWrapper.find( '#billing_country' ).val(), $wrapper ] );
                    $( document.body ).on( 'country_to_state_changing', self.onCountryToStateChange );
                }
            }

            /**
             * Check whether a postcode exemption exists or not.
             */
            if ( $countryField.length > 0 ) {
                var fieldPrefix = 'billing',
                    checkPostcodeExempt = true;

                if ( $countryField.attr( 'id' ).includes( 'shipping' ) ) {
                    fieldPrefix = 'shipping';
                }

                /**
                 * In case a (differing) shipping address is set, do not show/hide
                 * billing VAT ID field based on postcode exemptions.
                 */
                if ( relevantAddressType !== fieldPrefix ) {
                    checkPostcodeExempt = false;
                }

                if ( checkPostcodeExempt ) {
                    var $vatId    = $wrapper.find( '#' + fieldPrefix + '_vat_id' );
                    var $postcode = $wrapper.find( '#' + fieldPrefix + '_postcode' );

                    if ( $vatId.length > 0 && $postcode.length > 0 ) {
                        var $parent         = $vatId.closest( '.form-row' ),
                            country         = $countryField.val(),
                            exemptPostcodes = self.getVatExemptPostcodesByCountry( country ),
                            postcode        = $postcode.val().toString().toUpperCase().trim();

                        postcode = postcode.replace( /[\\s\\-]/, '' );

                        /**
                         * Allow passing a parameter to explicitly allow VAT Ids for UK
                         */
                        if ( 'GB' === country && 'no' === self.params.great_britain_supports_vat_id ) {
                            var postcodeStart = postcode.substring( 0, 2 );

                            if ( 'BT' === postcodeStart ) {
                                $parent.show();
                            } else {
                                $parent.hide();
                            }
                        } else if ( exemptPostcodes.length > 0 ) {
                            var isExempt = false;

                            $.each( exemptPostcodes, function( i, exemptPostcode ) {
                                if ( exemptPostcode.includes( '*' ) ) {
                                    exemptPostcode    = exemptPostcode.replace( '*', '' );
                                    var postcodeStart = postcode.substring( 0, exemptPostcode.length );

                                    if ( exemptPostcode === postcodeStart ) {
                                        isExempt = true;
                                        return false;
                                    }
                                } else if ( exemptPostcode === postcode ) {
                                    isExempt = true;
                                    return false;
                                }
                            } );

                            if ( isExempt ) {
                                $parent.hide();
                            } else {
                                $( document.body ).off( 'country_to_state_changing', self.onCountryToStateChange );
                                $( document.body ).trigger( 'country_to_state_changing', [ country, $wrapper ] );
                                $( document.body ).on( 'country_to_state_changing', self.onCountryToStateChange );
                            }
                        }
                    }
                }
            }

            /**
             * In case the vat id status is being refresh via AJAX make sure
             * to hide the optional/required indicators to prevent flashing.
             */
            if ( self.params.refresh_vat_id_status ) {
                var $vatIdField = $wrapper.find( '#billing_vat_id:visible, #shipping_vat_id:visible' ).parents( '.form-row' );

                if ( $vatIdField.length ) {
                    $vatIdField.find( 'label .required, label .optional' ).hide();
                }
            }
        }
    };

    $( document ).ready( function() {
        germanized.pro_checkout.init();
    });
})( jQuery, window.germanized );