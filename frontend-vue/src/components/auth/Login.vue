<template>
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Sign In</h5>
                    <form class="form-login" v-on:submit.prevent="onLogin">
                        <div class="form-label-group">

                            <input v-model="user.email" type="email" id="inputEmail" class="form-control"
                                   placeholder="Email address" required autofocus>
                        </div>

                        <div class="form-label-group">

                            <input v-model="user.password" type="password" id="inputPassword" class="form-control"
                                   placeholder="Password" required>
                        </div>

                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
                        <span class="red" v-if="wrong_credentials">{{ wrong_credentials }}</span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions} from 'vuex';

    export default {
        name: "Login",
        data: function () {
            return {
                user: {
                    email: '',
                    password: ''
                },

                input: {
                    email: {
                        type: ''
                    },
                    password: {
                        type: ''
                    }
                },
                wrong_credentials: false
            };
        },
        methods: {
            ...mapActions({
                login: 'auth/login'
            }),

            onLogin() {

                this.login(this.user).then((res) => {

                    this.$router.push({name: 'home'});
                }).catch((data) => {
                    if (data.error) {
                        this.wrong_credentials = 'Wrong email or password!';
                    }
                });


            },

        },
    }
</script>

<style scoped>
    .form-login input {
        margin-bottom: 5px;
    }
    .red {
        color: red;
        display: inline-block;
        width: 100%;
    }
</style>