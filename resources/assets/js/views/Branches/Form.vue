<template>
	<form @submit.prevent="createOrUpdate">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4>{{action}} Branch</h4>
			</div>
			<div class="panel-body">
				<div class="container-fluid">
					<input type="hidden" v-model="id" />
					<div class="row">
						<div class="form-group col col-xs-12 has-feedback"  :class="{ 'has-error' : error['name'] }">
							<label for="name">Name</label>
							<input type="text" class="form-control" id="name" placeholder="Enter Name" v-model="branch.name">
							<span class="help-block" v-if="error['name']">{{ error['name'].toString() }}</span>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<input type="submit" class="btn btn-primary" value="Save">
				<button class="btn btn-info"  @click="back">Cancel</button>
			</div>	
		</div>
	</form>	
</template>
<script type="text/javascript">
	import Vue from 'vue'
	import moment from 'moment'
	import { get, save } from '../../helpers/api'
	export default {
		data() {
			return {
				id: null,
				branch: {
					name: '',
				},
				error: {},
				isProcessing: false,
				url: 'api/branches',
				method: 'POST',
				action: 'Create',
			}
		},
		created() {
			if(this.$route.params.id) {
				this.url = `/api/branches/${this.$route.params.id}`
				this.method = 'PUT'
				this.action = 'Update'
				get(this.url)
					.then((res) => {
						this.branch = res.data.data
				}).catch((e) => {
					toastr.error('Error loading client')
				})
			}
		},
		methods: {
			createOrUpdate() {
				this.error = {}
				this.isProcessing = true
				save(this.url, this.branch, this.method)
				.then((res) => {
					this.isProcessing = false
					toastr.success('Save sucessful.')
					this.$router.go(-1)
				})
                .catch((err) => {
					this.isProcessing = false
					if(err.response.status === 422) {
						this.error = err.response.data.errors
						if(typeof this.error === 'string') {
							toastr.error(this.error)
						}
					}
					
				})
            },
			back() {
				 this.$router.go(-1)
			}
		}
	}
</script>
