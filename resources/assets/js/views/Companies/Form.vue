<template>
	<form @submit.prevent="createOrUpdate">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4>{{action}} Company</h4>
			</div>
			<div class="panel-body">
				<div class="container-fluid">
					<input type="hidden" v-model="id" />
					<div class="row">
						<div class="form-group col col-xs-6 has-feedback"  :class="{ 'has-error' : error['name'] }">
							<label for="name">Name</label>
							<input type="text" class="form-control" id="name" placeholder="Enter Name" v-model="client.name">
							<span class="help-block" v-if="error['name']">{{ error['name'].toString() }}</span>
						</div>
						<div class="form-group col col-xs-6 has-feedback"  :class="{ 'has-error' : error['contac_name'] }">
							<label for="contactName">Contact Name</label>
							<input type="text" class="form-control" id="contactName" placeholder="Enter Contact Name" v-model="client.contact_name">
							<span class="help-block" v-if="error['contact_name']">{{ error['contact_name'].toString() }}</span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col col-xs-6 has-feedback"  :class="{ 'has-error' : error['dni'] }">
							<label for="dni">Dni</label>
							<input type="text" class="form-control" id="dni" placeholder="Enter Dni" v-model="client.dni">
							<span class="help-block" v-if="error['dni']">{{ error['dni'].toString() }}</span>
						</div>
						<div class="form-group col col-xs-6 has-feedback"  :class="{ 'has-error' : error['email'] }">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" placeholder="Enter Email" v-model="client.email">
							<span class="help-block" v-if="error['email']">{{ error['email'].toString() }}</span>
						</div>
					</div>
					<div class="row">
						<div class="form-group col col-xs-12">
							<label for="address">Address</label>
							<input type="text" class="form-control" id="address" placeholder="Enter Address" v-model="client.address">
						</div>
						<div class="form-group col col-xs-6">
							<label for="phone">Phone</label>
							<input type="text" class="form-control" id="phone" placeholder="Enter Phone" v-model="client.phone">
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
				client: {
					name: '',
					dni: '',
					birthday: moment().format('YYYY-MM-DD'),
					email: '',
					phone: '',
					address: '',
				},
				error: {},
				isProcessing: false,
				url: 'api/companies',
				method: 'POST',
				action: 'Create',
				config: {
					format: 'YYYY/MM/DD',
					useCurrent: false,
				},   
			}
		},
		created() {
			if(this.$route.params.id) {
				this.url = `/api/companies/${this.$route.params.id}`
				this.method = 'PUT'
				this.action = 'Update'
				get(this.url)
					.then((res) => {
						this.client = res.data.data

				}).catch((e) => {
					toastr.error('Error loading client')
				})
			}
		},
		methods: {
			createOrUpdate() {
				this.error = {}
				this.isProcessing = true
				save(this.url, this.client, this.method)
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
