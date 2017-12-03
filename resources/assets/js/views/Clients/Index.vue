<template>
	<div class="panel panel-primary">
      	<div class="panel-heading">
			<h3>Clients</h3>
		</div>
		<div class="panel-body">
			<router-link class="btn btn-primary" :to="`/clients/create`" :disabled="isProcessing">
				<span v-if="isProcessing" >
					<i  class="fa fa-spinner fa-spin" aria-hidden="true"></i> loading...
				</span>
				<span v-else >
					<i class="fa fa-fw fa-plus" ></i> Add
				</span>
				
			</router-link>
		</div>
		<div class="list-group">
			<div v-for="client in clients">
				<router-link class="list-group-item" :to="`/clients/${client.id}`">
					<div class="row">
						<div class="col col-xs-5">
							<strong class="text-left">{{client.name}}</strong>
						</div>
						<div class="col col-xs-3">
							{{client.dni}}
						</div>
						<div class="col col-xs-4">
							{{client.birthDate}}
						</div>
					</div>
					<div class="row">
						<div class="col col-xs-12">
							{{client.email}}
						</div>
					</div>
					<div class="row">
						<div class="col col-xs-12">
							{{client.phone}}
						</div>
					</div>
				</router-link>
			</div>
		</div>
	</div>
</template>
<script type="text/javascript">
	import toastr from 'toastr'
	import { get } from '../../helpers/api'
	export default {
		data() {
			return {
				clients: [],
				isProcessing: false
			}
		},
		created() {
			this.isProcessing = true
			get('/api/clients')
				.then((res) => {
					this.clients = res.data.data
					this.isProcessing = false
				})
				.catch((e) => {
					toastr.error(e.message)
				} )
		}
	}
</script>
