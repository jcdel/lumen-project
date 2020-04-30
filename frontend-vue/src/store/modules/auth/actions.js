import httpService from '../../../services/common/httpService';

export default {

    login: (context, user) => {
        return new Promise((resolve, reject) => {

            httpService.post('auth/login', {
                email: user.email,
                password: user.password,
            })
                .then(function (res) {
                    
                    context.commit('USER_LOGIN', res.data);
                    context.dispatch('fetchAuthenticatedUser');
                    resolve(res);

                }).catch(function (err) {
                    reject(err.response.data);
                });
        });
    },
    logout: (context) => {
        return new Promise((resolve, reject) => {
            httpService.post('auth/logout')
                .then(function (res) {
                    context.commit('USER_LOGOUT', res);
                    resolve(res);
                }).catch(function (err) {
                    reject(err);
                });
        });
    },

    refreshToken: (context, email) => {
        return new Promise((resolve, reject) => {
            httpService.post('/auth/refresh', {
                params: {email}
            }).then(function (res) {
                context.commit('REFRESH_TOKEN', res.data.data.access_token);
                resolve(res);
            }).catch(function (err) {
                reject(err);
            });
        });
    },

    fetchAuthenticatedUser: (context) => {

        return new Promise((resolve, reject) => {

            httpService.get('/auth/me')
                .then(function (res) {

                    context.commit('SET_AUTHENTICATED_USER', res.data);
                    resolve(res);
                }).catch(function (error) {
                    reject(error);
                });
        });
    },


};
