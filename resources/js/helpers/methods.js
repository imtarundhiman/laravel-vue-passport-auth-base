export default {

    methods: {

        requestErrors(error){
            let errors = error.response.data;

            if(error.response.status == 422){
                this.$notify({
                    group: 'auth',
                    type: 'warn',
                    title: 'Error!',
                    text: 'Validation Errors !'
                });
                for (error in errors) {
                  $("*[name=" + error + "]").after(
                      '<span class="errors text-danger">' + errors[error] + "</span>"
                  );
                }
                return;
            }

            if(error.response.status == 500){
                this.$notify({
                    group: 'auth',
                    type: 'error',
                    title: 'Error!',
                    text: 'Internal Server Error !'
                });

                return;
            }

            this.$notify({
                group: 'auth',
                type: 'error',
                title: 'Error!',
                text: errors[0]
            });     
        }
    }
}