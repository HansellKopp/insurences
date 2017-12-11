<template>
	<div class="panel panel-primary">
      	<div class="panel-heading">
			<h4>{{client.name}}</h4>
		</div>
		<div class="panel-body"></div>
			<div class="container">
				<div class="row">
					<label class="control-label col-sm-4">Name:</label>
					<span class="col-sm-8 form-control-static">{{client.name}}</span>
				</div>
				<div class="row">
					<label class="control-label col-sm-4">Dni:</label>
					<span class="col-sm-8 form-control-static">{{client.dni}}</span>
				</div>
				<div class="row">
					<label class="control-label col-sm-4">Birth Date:</label>
					<span class="col-sm-8 form-control-static">{{client.birthday}}</span>
				</div>
				<div class="row">
					<label class="control-label col-sm-4">Email:</label>
					<span class="col-sm-8 form-control-static">{{client.email}}</span>
				</div>
				<div class="row">
					<label class="control-label col-sm-4">Phone:</label>
					<span class="col-sm-8 form-control-static">{{client.phone}}</span>
				</div>
				<div class="row">
					<label class="control-label col-sm-4">address:</label>
					<p class="col-sm-10 form-control-static">{{client.address}}</p>
				</div>
			</div>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<strong>Policies</strong>
				</div>
				<div class="panel-body table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Number</th>
								<th>Branch</th>
								<th>From</th>
								<th>To</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="policy in client.policies">
								<td>{{policy.number}}</td>
								<td>{{policy.branch}}</td>
								<td>{{policy.validity.from}}</td>
								<td>{{policy.validity.to}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		<div class="panel-footer">
			<router-link :to="`/clients/edit/${client.id}`" class="btn btn-primary">Edit</router-link>
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
				client: {
					client: {},
					policies: []
				}
			}
		},
		created() {
			get(`/api/clients/${this.$route.params.id}`)
				.then((res) => {
					this.client = res.data.data
				})
		},
		methods: {
			remove() {
				this.isRemoving = false
				del(`/api/clients/${this.$route.params.id}`)
					.then((res) => {
						toastr.success('You have successfully delete client.')
						this.$router.go(-1)
					})
			}
		}
	}
</script>
