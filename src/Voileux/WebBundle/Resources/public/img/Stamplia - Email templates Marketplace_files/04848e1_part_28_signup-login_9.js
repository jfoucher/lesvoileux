// Generated by CoffeeScript 1.4.0
(function() {

  App.View.SignupLogin = App.View.SignupForm.extend({
    tagName: 'div',
    id: 'signup',
    templateName: 'signup-login',
    events: {
      'click .twitter': "twitterLogin",
      'click .facebook': 'facebookLogin',
      'click .google': 'googleLogin',
      'submit form.login': 'signup',
      'click #signInSign': 'signup',
      'click #login': 'login',
      'click .show-form-toggle': 'showLoginForm'
    },
    initialize: function() {
      var _this = this;
      App.View.SignupForm.prototype.initialize.apply(this, arguments);
      return $(document).bind('login.success', function() {
        var redir;
        if (redir = App.getPref('redirect')) {
          App.unsetPref('redirect');
          return window.location.hash = redir;
        }
      });
    },
    render: function() {
      $(this.el).html(this.template());
      App.setActive('dashboard');
      this.breadcrumbs = [
        {
          label: 'Signup or Login'
        }
      ];
      App.setBreadcrumbs(this.breadcrumbs);
      return this.el;
    },
    showLoginForm: function(e) {
      e.preventDefault();
      this.clearErrors();
      this.$('.control-group.signup').toggle();
      return this.$('.control-group.login').toggle();
    },
    login: function(e) {
      var email, login, password,
        _this = this;
      e.preventDefault();
      this.clearErrors();
      email = $('#email').val();
      password = $('#password').val();
      login = App.client.login(email, password, 1);
      login.done(function(data) {
        return App.init().done(function() {
          window.location = '/backend#dashboard';
          App.router.navigate('uploads', {
            trigger: true
          });
          return $(document).trigger('login.success');
        });
      });
      return login.fail(function() {
        return _this.showErrors({
          errors: ['Could not log you in, please check your email and password']
        }, $(_this.el).find('form.login'));
      });
    }
  });

}).call(this);
