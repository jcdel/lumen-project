const TOKEN_EXPIRED = 'token_expired';

export default {
    auth: store => (to, from, next) => {

        if (!store.getters['auth/hasToken']()) {

            next({
                path: '/login'
            });

            return;
        }


        fetchUser(store)
            .then(() => {

                next( {path: to} );
            })
            .catch(() => {

                store.commit('auth/USER_LOGOUT');
                next({ path: '/login' });
            });

    },
    guest: store => (to, from, next) => {
        if (store.getters['auth/hasToken']()) {
            next({
                path: '/'
            });
        } else {
            next();
        }
    }
};

const refreshAuth = (store) => {
    return new Promise((resolve, reject) => {
        store.dispatch('auth/refreshToken')
            .then(() => {
                store.dispatch('auth/fetchAuthenticatedUser')
                    .then(() => {
                        resolve();
                    })
                    .catch(() => {
                        reject();
                    });
            })
            .catch(error => {
                reject(error);
            });
    });
};

const fetchUser = (store) => {

    return new Promise((resolve, reject) => {

        store.dispatch('auth/fetchAuthenticatedUser')
            .then(() => {
                 resolve();
            })
            .catch(response => {
                if (response.code === TOKEN_EXPIRED) {
                    refreshAuth(store);
                } else {
                    reject();
                }
            });
    });


};
