import Vue from 'vue';
import Vuex from 'vuex';

import auth from './modules/auth/index';
import post from './modules/post/index';
import comment from './modules/comment/index';

Vue.use(Vuex);

export default new Vuex.Store({

    strict: process.env.NODE_ENV !== 'production',
    modules: {
        auth,
        post,
        comment
    }
});