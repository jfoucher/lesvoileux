// Generated by CoffeeScript 1.4.0
(function() {

  App.View.Templates = App.View.extend({
    tagName: 'div',
    id: 'templates',
    className: 'admin-module clearfix',
    templateName: 'templates',
    breadcrumbs: null,
    templates: null,
    initialize: function() {
      this.templates = new App.Model.UserTemplateCollection;
      return this.templates.fetch();
    },
    render: function() {
      var _this = this;
      $(this.el).html(this.template());
      App.setActive('templates');
      this.breadcrumbs = [
        {
          label: App.user.get('name'),
          link: '#dashboard'
        }, {
          label: 'My Templates'
        }
      ];
      App.setBreadcrumbs(this.breadcrumbs);
      this.templates.fetched.done(function(tmpls) {
        var template, templates, tplView;
        templates = (function() {
          var _i, _len, _ref, _results;
          _ref = this.templates.models;
          _results = [];
          for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            template = _ref[_i];
            tplView = new App.View.Template({
              model: template
            });
            _results.push(tplView.render());
          }
          return _results;
        }).call(_this);
        $('#templates').find('.templates-list').html(templates);
        return App.resetHeight();
      });
      return this.el;
    }
  });

  App.View.Template = App.View.extend({
    tagName: 'li',
    templateName: 'template',
    render: function() {
      $(this.el).html(this.template({
        model: this.model
      }));
      return this.el;
    }
  });

}).call(this);
