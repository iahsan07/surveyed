export class HttpService {
    constructor() {
        this.baseUrl = window.location.protocol + '//' + window.location.hostname + '/';
        this.cancelTokenSource = null // to control pending requests
    }

    setBaseUrl() {
        this.baseUrl = window.location.protocol + '//' + window.location.hostname + '/portal/'
        return this
    }

    get($uri, $params) {

        if (this.cancelTokenSource) {
            this.cancelTokenSource.cancel();
        }

        this.cancelTokenSource = axios.CancelToken.source();

        return new Promise((resolve, reject) => {
            axios.get(this.baseUrl + $uri, {
                params: $params,
                cancelToken: this.cancelTokenSource.token,
            })
                .then(response => {
                    resolve(response.data);
                })
                .catch(errors => {
                    reject(errors);
                })
        });
    }


    post($uri, $formData) {

        return new Promise((resolve, reject) => {
            axios.post(this.baseUrl + $uri, $formData, {
                headers: {
                    'Authorization': `Bearer ${App.user ? App.user.api_token : ''}`
                },
            })
                .then(response => {
                    resolve(response.data);
                })
                .catch(errors => {
                    reject(errors);
                })
        });
    }

    delete($uri) {

        return new Promise((resolve, reject) => {
            axios.delete(this.baseUrl + $uri, {
                headers: {
                    'Authorization': `Bearer ${App.user ? App.user.api_token : ''}`
                },
            })
                .then(response => {
                    resolve(response.data);
                })
                .catch(errors => {
                    reject(errors);
                })
        });
    }
}
