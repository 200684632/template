<template>
	<div id="app">
		<router-view></router-view>
	</div>
</template>
<script>
	export default {
		data() {
			return {

			}
		},
		computed: {
            user_authorized() {
                return this.$store.getters.user_authorized
            },
            error_occured() {
                return this.$store.state.app.error
            }
        },
        watch: {
            user_authorized(newVal, oldVal) {
                if (newVal === true) {
                    this.$router.replace('/')
                } else {
                    this.$router.go('/login')
                }
            },
            error_occured(newVal) {
                if (!!newVal) {
                    this.$notify({
                        title: '错误',
                        message: newVal.errmsg
                    })
                }
            }
        }
	}
</script>