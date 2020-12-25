import axios from "axios";

export default {
    methods: {
        post(url, data, onSuccess, onError) {
            axios.post(window.appConfig.appUrl + url, data)
                .then(
                    function(response) {
                        if (onSuccess) onSuccess(response);
                    }.bind(this)
                )
                .catch(
                    ({response}) => {
                        if (onError) onError(response);
                    }
                );
        },
        redirect(route) {
            location.href = window.appConfig.appUrl + route;
        },
    }
}