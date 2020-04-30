import StorageService from '../../../services/common/storageService';

export default {

    USER_LOGIN: (state, response) => {
        StorageService.setToken(response.access_token);
        state.token = response.access_token;
        state.isLoggedIn = true;
    },
    USER_LOGOUT: (state) => {
        StorageService.removeToken();
        state.token = '';
        state.currentUser = {
            name: '',
            email: '',
            id: null,

        };
        state.isLoggedIn = false;
    },
    SET_AUTHENTICATED_USER: (state, user) => {
        state.isLoggedIn = true;
        state.currentUser = user;
    },

};
