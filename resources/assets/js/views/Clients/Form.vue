<template>
	<div class="panel panel-primary">
      	<div class="panel-heading">
			<h4>{{action}} client</h4>
		</div>
		<div class="panel-body"></div>
			<form class="container-fluid">
				<input type="hidden" v-model="id"></input>
				<div class="row">
					<div class="form-group col col-xs-12 has-feedback"  :class="{ 'has-error' : error['name'] }">
						<label for="name">Name</label>
						<input type="text" class="form-control" id="name" placeholder="Enter Name" v-model="client.name">
						<span class="help-block" v-if="error['name']">{{ error['name'].toString() }}</span>
					</div>
				</div>
				<div class="row">
					<div class="form-group col col-xs-6 has-feedback"  :class="{ 'has-error' : error['dni'] }">
						<label for="dni">Dni</label>
						<input type="text" class="form-control" id="dni" placeholder="Enter Dni" v-model="client.dni">
						<span class="help-block" v-if="error['dni']">{{ error['dni'].toString() }}</span>
					</div>
					<div class="form-group col col-xs-6">
						<label for="birthDate">Birthdate</label>
						<Datepicker v-model="client.birthDate"></Datepicker>
					</div>
				</div>
				<div class="row">
					<div class="form-group col col-xs-6 has-feedback"  :class="{ 'has-error' : error['email'] }">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" placeholder="Enter Email" v-model="client.email">
						<span class="help-block" v-if="error['email']">{{ error['email'].toString() }}</span>
					</div>
					<div class="form-group col col-xs-6">
						<label for="phone">Phone</label>
						<input type="text" class="form-control" id="phone" placeholder="Enter Phone" v-model="client.phone">
					</div>
				</div>
				<div class="row">
					<div class="form-group col col-xs-12">
						<label for="address">Address</label>
						<input type="text" class="form-control" id="address" placeholder="Enter Address" v-model="client.address">
					</div>
				</div>
			</form>
			<div class="panel-footer">
				<input type="submit" class="btn btn-primary" @click="save" value="Save">
				<button class="btn btn-info"    @click="back">Cancel</button>
			</div>
	</div>
</template>
<script type="text/javascript">
	import Vue from 'vue'
	import { get, post } from '../../helpers/api'

	export default {
		data() {
			return {
				id: null,
				client: {
					name: '',
					dni: '',
					birthDate: '2017-01-01',
					email: '',
					phone: '',
					address: '',
				},
				error: {},
				isProcessing: false,
				action: 'Create'
			}
		},
		methods: {
			save() {
                this.isProcessing = true
                this.error = {}
                post('api/clients', this.client)
                    .then((res) => {
						this.isProcessing = false
                        toastr.success('Save sucessful.')
                        this.$router.go(-1)
                    })
                    .catch((err) => {
                        if(err.response.status === 422) {
                            this.error = err.response.data.errors
                        }
                        this.isProcessing = false
                    })
            },
			back() {
				 this.$router.go(-1)
			}
		}
	}
</script>
