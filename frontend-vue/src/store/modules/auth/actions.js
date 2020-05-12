import httpService from '@/services/common/httpService';

export default {

    async login(context, user){
        try {
            const result = await httpService.post('auth/login', {
                email: user.email,
                password: user.password,
            });
            context.commit('USER_LOGIN', result.data);
            context.dispatch('fetchAuthenticatedUser');

            return Promise.resolve(result);
        } catch(err) {
            return Promise.reject(err.response.data);
        }
    },

    async logout(context){
        try {
            const result = await httpService.post('auth/logout');
            context.commit('USER_LOGOUT', result);

            return Promise.resolve(result);
        } catch(err) {
            return Promise.reject(err);
        }
    },

    async refreshToken(context, email){
        try {
            const result = await httpService.post('/auth/refresh', {
                params: {email}
            });
            context.commit('REFRESH_TOKEN', result.data.data.access_token);

            return Promise.resolve(result);
        } catch(err) {
            return Promise.reject(err);
        }
    },

    async fetchAuthenticatedUser(context){
        try {
            const result = await httpService.get('/auth/me');
            context.commit('SET_AUTHENTICATED_USER', result.data);

            return Promise.resolve(result);
        } catch(err) {
            return Promise.reject(err);
        }
    },
};
