;(function ( $, window, document, undefined ) {

    var pluginName = "fullWidthSlider",
        defaults = {
            speed : 800,
            // if true the item's slices will also animate the opacity value
            optOpacity : false,
            // amount (%) to translate both slices - adjust as necessary
            translateFactor : 230,
            // maximum possible angle
            maxAngle : 25,
            // maximum possible scale
            maxScale : 2,
            // slideshow on / off
            autoplay : false,
            // keyboard navigation
            keyboard : true,
            // time between transitions
            interval : 4000,
            // callbacks
            onBeforeChange : function( slide, idx ) { return false; },
            onAfterChange : function( slide, idx ) { return false; }
        };
    var $window = $( window ),
        $document = $( document );

    // The actual plugin constructor
    function Slider( element, options ) {
        this.element = element;
        this.$el = $(element);

        // jQuery has an extend method which merges the contents of two or
        // more objects, storing the result in the first object. The first object
        // is generally empty as we don't want to alter the default options for
        // future instances of the plugin
        this.options = $.extend( {}, defaults, options );

        this._defaults = defaults;
        this._name = pluginName;

        this.init();
    }

    Slider.prototype = {

        init: function() {
            // the slides
            this.$slides = this.$el.children( 'li' ).hide();

            this.$el.children( 'li:first' ).show();
            // total slides
            this.slidesCount = this.$slides.length;
            // current slide
            this.current = 0;
            // control if it's animating
            this.isAnimating = false;
            // load some events
            this.loadEvents();
            // slideshow
            if( this.options.autoplay ) {

                this.startSlideshow();

            } else {
                this.navigate('next')
            }


//            var height = this.$slides.first().height();
//            this.$el.css({'height': height});
//            this.$slides.css({'position': 'absolute', 'top': 0, 'left': 0});


        },

        loadEvents: function() {

            var self = this;

            this.$slides.hover(function(){
                self.stopSlideshow();
            }, function(){
                self.options.autoplay = true;
                self.startSlideshow();
            });

            if ( this.options.keyboard ) {

                $document.on( 'keydown.slitslider', function(e) {

                    var keyCode = e.keyCode || e.which,
                        arrow = {
                            left: 37,
                            up: 38,
                            right: 39,
                            down: 40
                        };

                    switch (keyCode) {

                        case arrow.left :

                            self.stopSlideshow();
                            self.navigate( 'prev' );
                            break;

                        case arrow.right :

                            self.stopSlideshow();
                            self.navigate( 'next' );
                            break;

                    }

                } );

            }

        },
        navigate: function( dir, pos ) {

            if( this.isAnimating || this.slidesCount < 2 ) {

                return false;

            }

            this.isAnimating = true;

            var self = this,
                $currentSlide = this.$slides.eq( this.current );

            // if position is passed
            if( pos !== undefined ) {

                this.current = pos;

            }
            // if not check the boundaries
            else if( dir === 'next' ) {

                this.current = this.current < this.slidesCount - 1 ? ++this.current : 0;

            }
            else if( dir === 'prev' ) {

                this.current = this.current > 0 ? --this.current : this.slidesCount - 1;

            }

            this.options.onBeforeChange( $currentSlide, this.current );

            // next slide to be shown
            var $nextSlide = this.$slides.eq( this.current ),
            // the slide we want to cut and animate
                $movingSlide = ( dir === 'next' ) ? $currentSlide : $nextSlide;

            $nextSlide.css({'z-index': 10, 'position': 'absolute', 'top': 0, 'left': 0});
            $movingSlide.css({'z-index': 1, 'float': 'left', 'position': 'static'});

            $nextSlide.fadeIn(1000, function(){
                self.$slides.find('.description').hide();
                $nextSlide.css({'z-index': 1, 'float': 'left', 'position': 'static'});
                $nextSlide.find('.description').fadeIn();


                $movingSlide.hide();

                self.isAnimating = false;
            });

        },
        play : function() {

            if( !this.isPlaying ) {

                this.isPlaying = true;

                this.navigate( 'next' );
                this.options.autoplay = true;
                this.startSlideshow();

            }

        },

        startSlideshow: function() {

            var self = this;

            this.slideshow = setTimeout( function() {

                self.navigate( 'next' );

                if ( self.options.autoplay ) {

                    self.startSlideshow();

                }

            }, this.options.interval );

        },
        stopSlideshow: function() {

            if ( this.options.autoplay ) {

                clearTimeout( this.slideshow );
                this.isPlaying = false;
                this.options.autoplay = false;

            }

        }
    };

    // A really lightweight plugin wrapper around the constructor,
    // preventing against multiple instantiations
    $.fn[pluginName] = function ( options ) {
        return this.each(function () {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName, new Slider( this, options ));
            }
        });
    };

})( jQuery, window, document );