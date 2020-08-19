@extends('default')

@section('content')
<section class="px-2 px-md-0 py-md-7">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-6 col-lg-4 mx-auto">
                <div class="card mb-0 border-0"
                        {{--                     style="background-color:transparent;box-shadow:none;"--}}
                >
                    <div class="card-header"><h5 class="card-title">{{ trans('auth.register_baseline') }}</h5></div>
                    <div class="card-body p-3">
                        {!! Form::open(['route' => ['register'], 'method' => 'POST']) !!}
                        @honeypot
                        <div class="form-group">
                            <div class="input-group">
                                <input
                                        type="text"
                                        name="friend_code"
                                        class="form-control {{ $errors && $errors->has('friend_code') ? 'is-invalid' : '' }}"
                                        placeholder="{{ trans('users.profiles.friend_code') }}"
                                        value="{{ old('friend_code') }}"
                                />
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-users"></span>
                                    </div>
                                </div>
                            </div>
                            @if ($errors && $errors->has('friend_code'))
                                <div class="text-danger text-sm">{{ $errors->first('friend_code') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input
                                        type="email"
                                        name="email"
                                        class="form-control {{ $errors && $errors->has('email') ? 'is-invalid' : '' }}"
                                        placeholder="{{ trans('users.email') }}"
                                        value="{{ old('email') }}"
                                />
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            @if ($errors && $errors->has('email'))
                                <div class="text-danger text-sm">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input
                                        type="password"
                                        name="password"
                                        class="form-control {{ $errors && $errors->has('password') ? 'is-invalid' : '' }}"
                                        placeholder="{{ trans('users.password') }}"
                                />
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            @if ($errors && $errors->has('password'))
                                <div class="text-danger text-sm">{{ $errors->first('password') }}</div>
                            @endif
                        </div>


{{--                        <gmap-autocomplete class="introInput" >--}}
{{--                            <template v-slot:input="slotProps">--}}
{{--                                <v-text-field outlined--}}
{{--                                              prepend-inner-icon="place"--}}
{{--                                              placeholder="Location Of Event"--}}
{{--                                              ref="input"--}}
{{--                                              v-on:listeners="slotProps.listeners"--}}
{{--                                              v-on:attrs="slotProps.attrs">--}}
{{--                                </v-text-field>--}}
{{--                            </template>--}}
{{--                        </gmap-autocomplete>--}}

                        <div id="locationField">
                            <input id="autocomplete"
                                   placeholder="Enter your address"
                                   onFocus="geolocate()"
                                   type="text"/>
                        </div>

                        <!-- Note: The address components in this sample are typical. You might need to adjust them for
                                   the locations relevant to your app. For more information, see
                             https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete-addressform
                        -->

                        <table id="address">
                            <tr>
                                <td class="label">Street address</td>
                                <td class="slimField"><input class="field" id="street_number" disabled="true"/></td>
                                <td class="wideField" colspan="2"><input class="field" id="route" disabled="true"/></td>
                            </tr>
                            <tr>
                                <td class="label">City</td>
                                <td class="wideField" colspan="3"><input class="field" id="locality" disabled="true"/></td>
                            </tr>
                            <tr>
                                <td class="label">State</td>
                                <td class="slimField"><input class="field" id="administrative_area_level_1" disabled="true"/></td>
                                <td class="label">Zip code</td>
                                <td class="wideField"><input class="field" id="postal_code" disabled="true"/></td>
                            </tr>
                            <tr>
                                <td class="label">Country</td>
                                <td class="wideField" colspan="3"><input class="field" id="country" disabled="true"/></td>
                            </tr>
                        </table>

                        <script>
                          // This sample uses the Autocomplete widget to help the user select a
                          // place, then it retrieves the address components associated with that
                          // place, and then it populates the form fields with those details.
                          // This sample requires the Places library. Include the libraries=places
                          // parameter when you first load the API. For example:
                          // <script
                          // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

                          var placeSearch, autocomplete;

                          var componentForm = {
                            street_number: 'short_name',
                            route: 'long_name',
                            locality: 'long_name',
                            administrative_area_level_1: 'short_name',
                            country: 'long_name',
                            postal_code: 'short_name'
                          };

                          function initAutocomplete() {
                            // Create the autocomplete object, restricting the search predictions to
                            // geographical location types.
                            autocomplete = new google.maps.places.Autocomplete(
                              document.getElementById('autocomplete'), {types: ['geocode']});

                            // Avoid paying for data that you don't need by restricting the set of
                            // place fields that are returned to just the address components.
                            autocomplete.setFields(['address_component', 'geometry']);

                            // When the user selects an address from the drop-down, populate the
                            // address fields in the form.
                            autocomplete.addListener('place_changed', fillInAddress);
                          }

                          function fillInAddress() {
                            // Get the place details from the autocomplete object.
                            var place = autocomplete.getPlace();

                            var latitude = place.geometry.location.lat();
                            var longitude = place.geometry.location.lng();

                            console.log('place', latitude);
                            console.log('place', longitude);

                            for (var component in componentForm) {
                              document.getElementById(component).value = '';
                              document.getElementById(component).disabled = false;
                            }

                            // Get each component of the address from the place details,
                            // and then fill-in the corresponding field on the form.
                            for (var i = 0; i < place.address_components.length; i++) {
                              var addressType = place.address_components[i].types[0];
                              if (componentForm[addressType]) {
                                var val = place.address_components[i][componentForm[addressType]];
                                document.getElementById(addressType).value = val;
                              }
                            }
                          }

                          // Bias the autocomplete object to the user's geographical location,
                          // as supplied by the browser's 'navigator.geolocation' object.
                          function geolocate() {
                            if (navigator.geolocation) {
                              navigator.geolocation.getCurrentPosition(function(position) {
                                var geolocation = {
                                  lat: position.coords.latitude,
                                  lng: position.coords.longitude
                                };
                                var circle = new google.maps.Circle(
                                  {center: geolocation, radius: position.coords.accuracy});
                                autocomplete.setBounds(circle.getBounds());
                              });
                            }
                          }
                        </script>
                        <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.api_key') }}&libraries=places&callback=initAutocomplete" defer></script>


                        <div class="sm-p-t-10 clearfix"></div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ trans('auth.register') }}
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
