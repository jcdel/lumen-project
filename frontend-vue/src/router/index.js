import Vue from 'vue'
import Router from 'vue-router'
import store from '../store/index';
import middlewares from './middlewares';
import PostsList from '../pages/PostsList.vue'
import UserPostsList from '../pages/UserPostsList.vue'
import SinglePost from '../pages/SinglePost.vue'
import EditPost from '../pages/EditPost.vue'
import AddPost from '../pages/AddPost.vue'
import LoginPage from '../pages/LoginPage.vue'

Vue.use(Router)

const middleware = handler => (
    routes => routes.map(route => Object.assign({}, route, {beforeEnter: handler}))
);

export default new Router({
    mode: 'history',
    base: '/',
    scrollBehavior: () => ({y: 0}),
    routes: [
        ...middleware(middlewares.auth(store))([
            {
                path: '/',
                name: 'home',
                redirect: '/posts'
            },
            {
                path: '/posts',
                name: 'PostsList',
                component: PostsList
            },
            {
                path: '/posts/me',
                name: 'UserPostsList',
                component: UserPostsList
            },
            {
                path: '/posts/add',
                name: 'AddPost',
                component: AddPost
            },
            {
                path: '/posts/:id',
                name: 'SinglePost',
                component: SinglePost
            },
            {
                path: '/posts/:id/edit',
                name: 'EditPost',
                component: EditPost
            }
        ]),
        ...middleware(middlewares.guest(store))([
            {
                path: '/login',
                name: 'LoginPage',
                component: LoginPage
            },


        ])
    ]
})
