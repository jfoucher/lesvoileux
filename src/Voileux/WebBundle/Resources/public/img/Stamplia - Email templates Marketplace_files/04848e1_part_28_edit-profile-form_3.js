// Generated by CoffeeScript 1.4.0
(function() {

  App.View.EditProfileForm = App.View.extend({
    tagName: 'div',
    className: 'modifyInfo',
    id: 'edit-form',
    templateName: 'edit-profile-form',
    events: {
      'click .edit-info-button': "makeEditable",
      'click .save-info-button': "saveInfo",
      'submit .edit-info': "saveInfo"
    },
    render: function() {
      $(this.el).html(this.template());
      return this.el;
    },
    makeEditable: function(e) {
      if (e != null) {
        e.preventDefault();
      }
      $(this.el).show();
      $('#editInfoSubmit').removeClass('edit-info-button').addClass('save-info-button');
      return this.$('input').removeAttr('disabled');
    },
    saveInfo: function(e) {
      var btn, data,
        _this = this;
      e.preventDefault();
      btn = $('#editInfoSubmit');
      btn.addClass('loading');
      data = {
        name: $('#accountManager').val(),
        company: $('#company').val(),
        password: $('#password').val(),
        avatar: $('#avatar').val(),
        paypal_email: $('#paypal-email').val()
      };
      App.user.set(data);
      return App.user.save().done(function() {
        return btn.removeClass('loading').removeClass('disabled');
      });
    },
    addError: function(text, elem) {
      return elem.before('<ul class="error"><li class="error">' + text + '</li></ul>');
    }
  });

}).call(this);
