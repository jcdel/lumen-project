import axios from 'axios';
import storageService from './storageService';
import apiURL from './config.js';

export class HttpService {

    constructor() {
        this.headers = {
            'Access-Control-Allow-Origin': '*',
            'Content-Type': 'application/json'
        }
        this.axios = axios.create({
            baseURL: apiURL.API_URL
        });

        this.axios.interceptors.request.use(
            config => {
                if (storageService.getToken()) {
                    config.headers['Authorization'] = 'Bearer ' + storageService.getToken();
                }
                return Promise.resolve(config);
            },
            error => {
                return Promise.reject(error);
            }
        );
    }

    get(url, params) {

        return this.axios.get(url, params);
    }

    post(url, data) {

        return this.axios.post(url, data, { crossdomain: true });
    }

    put(url, data) {
        return this.axios.put(url, data);
    }

    delete(url, params) {
        return this.axios.delete(url, params);
    }

    getPhoto(url = apiURL.PHOTO_API_URL) {

        return this.axios.get(url);
    }
}

export default new HttpService();