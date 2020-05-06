import httpService from '@/services/common/httpService';

export default {

    getPosts: (context, page) => {

        return new Promise((resolve, reject) => {
            httpService.get('posts?page=' + page)
                .then(function (res) {
                    //console.log(res.data);
                    context.commit('SET_POSTS', res.data);
                    resolve(res);

                }).catch(function (err) {
                reject(err);
            });
        });
    },
    getPostsByUser: (context, page) => {

        return new Promise((resolve, reject) => {
            httpService.get('posts/me?page=' + page)
                .then(function (res) {
                    context.commit('SET_USER_POSTS', res.data);
                    resolve(res);

                }).catch(function (err) {
                reject(err);
            });
        });
    },

    addPost: (context, post) => {

        return new Promise((resolve, reject) => {
            httpService.post('posts', {
                user_id: post.user_id,
                title: post.title,
                image: post.image,
                text: post.text,
            })
                .then(function (res) {
                    context.dispatch('getPhoto');
                    resolve(res);

                }).catch((error) => {
                reject(error.response.data);
            });
        });
    },

    getPhoto: (context) => {

        return new Promise((resolve, reject) => {
            httpService.getPhoto()
                .then(function (res) {
                    context.commit('SET_PHOTO', res.data);
                    resolve(res);
                }).catch(function (error) {
                    reject(error);
                });
        });
    },
    
    updatePost: (context, post) => {

        return new Promise((resolve, reject) => {
            httpService.put('posts/' + post.id, {
                title: post.title,
                text: post.text,
                image: post.image,
            })
                .then(function (res) {

                    context.commit('SET_POST', res.data.data);
                    resolve(res);

                }).catch((error) => {
                reject(error.response.data);
            });
        });
    },
    getPost: (context, post_id) => {

        return new Promise((resolve, reject) => {

            httpService.get('posts/' + post_id)
                .then(function (res) {

                    context.commit('SET_POST', res.data.data);
                    resolve(res);

                }).catch(function (err) {
                reject(err);
            });
        });
    },
    deletePost: (context, post_id) => {

        return new Promise((resolve, reject) => {

            httpService.delete('posts/' + post_id)
                .then(function (res) {

                    context.commit('DELETE_POST', post_id);
                    resolve(res);

                }).catch(function (err) {
                reject(err);
            });
        });
    },
};
