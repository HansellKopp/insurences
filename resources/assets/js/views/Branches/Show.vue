<template>
	<div class="panel panel-primary">
      	<div class="panel-heading">
			<h4>{{branch.name}}</h4>
		</div>
		<div class="panel-body">
			<div class="container">
				<div class="row">
					<label class="control-label col-sm-4">Name:</label>
					<span class="col-sm-8 form-control-static">{{branch.name}}</span>
				</div>
			</div>
		</div>
		<div class="panel-footer">
			<router-link :to="`/branches/edit/${branch.id}`" class="btn btn-primary">Edit</router-link>
			<button class="btn btn-danger" @click="remove" :disabled="isRemoving">Delete</button>
		</div>
	</div>
</template>
<script type="text/javascript">
	import Auth from '../../store/auth'
	import { get, del } from '../../helpers/api'
	export default {
		data() {
			return {
				authState: Auth.state,
				isRemoving: false,
				baseUrl: '/api/branches/',
				branch: {
					name: {}
				}
			}
		},
		created() {
			get(`${this.baseUrl}${this.$route.params.id}`)
				.then((res) => {
					this.branch = res.data.data
				})
		},
		methods: {
			remove() {
				this.isRemoving = false
				if(!confirm('are you sure ?')) {
					return
				}
				del(`${this.baseUrl}${this.$route.params.id}`)
					.then((res) => {
						toastr.success('You have successfully delete company.')
						this.$router.go(-1)
					})
			}
		}
	}
</script>