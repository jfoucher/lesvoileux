// Generated by CoffeeScript 1.4.0
(function() {

  App.View.Profile = App.View.extend({
    tagName: 'div',
    id: 'my-profile',
    className: 'admin-module',
    templateName: 'profile',
    breadcrumbs: null,
    profileEditForm: null,
    messages: null,
    events: {
      'click .modify': 'makeProfileEditable'
    },
    initialize: function() {
      var _this = this;
      App.user.bind('change', function() {
        return _this.displayUserData();
      });
      App.user.bind('sync', function() {
        return _this.displayUserData();
      });
      App.messages.bind('sync', function() {
        return _this.showMessages();
      });
      return App.messages.bind('reset', function() {
        return _this.showMessages();
      });
    },
    render: function() {
      var _this = this;
      $(this.el).html(this.template());
      App.setActive('profile');
      this.breadcrumbs = [
        {
          label: App.user.get('name'),
          link: '#dashboard'
        }, {
          label: 'My Profile'
        }
      ];
      App.setBreadcrumbs(this.breadcrumbs);
      App.start().done(function() {
        _this.profileEditForm = new App.View.EditProfileForm();
        _this.$('.userData').prepend(_this.profileEditForm.render());
        _this.$('#edit-form').hide();
        _this.showMessages();
        return App.resetHeight();
      });
      App.resetHeight();
      return this.el;
    },
    makeProfileEditable: function(e) {
      var _this = this;
      e.preventDefault();
      this.$('.userData').find('.display').hide();
      $('#my-info .interior,#my-messages-lite .interior').animate({
        height: 360
      }, function() {
        return App.resetHeight();
      });
      return this.profileEditForm.makeEditable();
    },
    displayUserData: function() {
      var _this = this;
      this.$('#edit-form').hide();
      this.$('.userData').find('.display').show();
      this.$('.userTitle').text(App.user.get('name'));
      this.$('.company-display').text(App.user.get('company'));
      this.$('.email-display').text(App.user.get('email'));
      $('#my-info .interior, #my-messages-lite .interior').animate({
        height: 180
      }, function() {
        return App.resetHeight();
      });
      if (App.user.get('avatar')) {
        return this.$('.avatar').attr('src', App.user.get('avatar'));
      }
    },
    showMessages: function() {
      var message, res, view,
        _this = this;
      this.$('.tooltip').hide();
      this.messages = _.filter(App.messages.models, function(msg) {
        return !msg.get('read');
      });
      if (this.messages.length) {
        this.$('.tooltip').css({
          'display': 'inline-block'
        });
        this.$('.tooltip').html(this.messages.length);
        res = (function() {
          var _i, _len, _ref, _results;
          _ref = this.messages;
          _results = [];
          for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            message = _ref[_i];
            view = new App.View.ProfileMessage({
              model: message
            });
            _results.push(view.render());
          }
          return _results;
        }).call(this);
      } else {
        res = '<li><div class="feedback"><strong>No unread messages</strong></div></li>';
      }
      this.$('.messages').html(res);
      return App.resetHeight();
    }
  });

  App.View.ProfileMessage = App.View.extend({
    tagName: 'li',
    templateName: 'profile-message',
    render: function() {
      $(this.el).html(this.template({
        model: this.model
      }));
      return this.el;
    }
  });

}).call(this);
