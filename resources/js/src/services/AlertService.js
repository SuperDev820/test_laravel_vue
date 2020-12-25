
export default {
    methods: {
        AlertShow(state, message) {
            this.$notify({
                timeout: 2500,
                message: message,
                horizontalAlign: "right",
                verticalAlign: "top",
                icon: "add_alert",
                type: state
            });
        }
    }
}