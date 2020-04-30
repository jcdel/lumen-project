<template>
    <div class="col-sm-12">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <router-link to="/" class="navbar-brand">Home</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link :to="{ name: 'UserPostsList' }" class="nav-link" v-if="isUserLoggedIn">My posts
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{ name: 'AddPost' }" class="nav-link" v-if="isUserLoggedIn">Add post
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{ name: 'LoginPage' }" class="nav-link" v-if="!isUserLoggedIn">Login
                        </router-link>
                        <a class="nav-link logout-btn" v-if="isUserLoggedIn" @click="onLogOut">Log out</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
    import {mapActions, mapGetters, mapState} from 'vuex';

    export default {
        computed: {
            ...mapGetters({
                isUserLoggedIn: 'auth/isLoggedIn',
                user: 'auth/getAuthenticatedUser',

            }),
            ...mapState('auth', ['currentUser']),

        },
        methods: {
            ...mapActions({
                logout: 'auth/logout',
            }),

            onLogOut() {
                this.logout()
                    .then(() => {
                        this.$router.push({name: 'LoginPage'});
                    });
            },

        },
    }
</script>

<style scoped>
    .logout-btn {
        cursor: pointer;
    }
</style>
