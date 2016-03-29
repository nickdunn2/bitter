'use strict';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var PostModel = Backbone.Model.extend({
    urlRoot: '/posts',
    idAttribute: 'id',

    defaults: {
        post_content: ''
    }
});

var PostsCollection = Backbone.Collection.extend({
    url: '/posts',
    model: PostModel,
    parse: function(resp) {
        return resp.data;
    }
});

var HomeView = Backbone.View.extend({
    el: '#main',

    template: _.template($('#mainTemplate').html()),

    render: function() {
        this.$el.html(this.template());
        var posts = new PostsCollection();
        posts.fetch();
        var addPostView = new AddPostView({ collection: posts });
        addPostView.render();
        var postsView = new PostsView({ collection: posts });
        this.$el.find('#all-posts').html(postsView.render().el);
        return this;
    }
});

var PostView = Backbone.View.extend({
    tagName: 'li',

    className: 'post',

    events: {
        // 'click h2': 'alertStatus'
    },

    template: _.template($('#postTemplate').html()),

    render: function() {
        var attributes = this.model.toJSON();
        this.$el.html(this.template(attributes));
        return this;
    },

    alertStatus: function(e) {
        e.preventDefault();
        alert('Hey yeah! You clicked the h2!');
    }
});

var PostsView = Backbone.View.extend({
    tagName: 'ul',

    initialize: function() {
        this.collection.on('update', this.render, this);
        this.collection.on('sync', this.addNew, this);
        // this.collection.on('reset', this.addAll, this);
    },

    addOne: function(post) {
        var postView = new PostView({ model: post });
        this.$el.append(postView.render().el);
    },

    addNew: function(post) {
        var postView = new PostView({ model: post });
        this.$el.prepend(postView.render().el);
    },

    addAll: function() {
        this.collection.forEach(this.addOne, this);
    },

    render: function() {
        this.addAll();
        return this;
    }
});

var AddPostView = Backbone.View.extend({
    el: '#add-post',

    template: _.template($('#addPostTemplate').html()),

    events: {
        'submit': 'addPost'
    },

    addPost: function(e) {
        e.preventDefault();
        this.collection.create({
            post_content: this.$('#new-post').val()
        }, { wait: true });

        this.clearForm();
    },

    clearForm: function() {
        this.$('#new-post').val('');
    },

    render: function() {
        this.$el.html(this.template());
        return this;
    }
});

var homeView = new HomeView();
homeView.render();



