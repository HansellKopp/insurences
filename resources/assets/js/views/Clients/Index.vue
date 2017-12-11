<template>
	<div class="panel panel-primary">
      	<div class="panel-heading">
			<div class="row">
				<div class="col col-xs-6">
					<strong>Clients</strong>
				</div>
				<div class="col col-xs-6">
					<router-link class="btn btn-primary pull-right" :to="`/clients/create`" :disabled="isProcessing">
						<span v-if="isProcessing" >
							<i  class="fa fa-spinner fa-spin" aria-hidden="true"></i> loading...
						</span>
						<span v-else >
							<i class="fa fa-fw fa-plus" ></i> Add
						</span>
					</router-link>
			 	</div>
			</div>
		</div>
		<div class="panel-body">
			<ul class="pager">
				<li class="previous" @click="loadPreviousPage"><a href="#">&larr; Previous</a></li>
				{{ this.meta.current_page }} / {{ this.meta.last_page }}
				<li class="next" @click="loadNextPage"><a href="#">Next &rarr;</a></li>
			</ul>
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
				isProcessing: false,
				currentSort: 'name',
				links: [],
				meta: {
					current_page: 1,
					last_page: 1
				}
			}
		},
		created() {
			this.loadData();
        	document.getElementById('app-navbar-collapse').classList.remove('in')
		},
		computed: {
    		currentUrl: function () {
				return `/api/clients?
				sort_by=${this.currentSort}&
				page=${this.meta.current_page}`
			}
		},
		methods: {
			loadData: function() {
				this.isProcessing = true
				get(this.currentUrl)
					.then((res) => {
						this.clients = res.data.data
						this.links = res.data.links
						this.meta  = res.data.meta
						this.isProcessing = false
					})
					.catch((e) => {
						toastr.error(e.message)
					} )
			},
			loadNextPage: function () {
				if(this.isProcesing) {
					return
				}
				if((this.meta.current_page < this.meta.last_page) && !this.isProcesing) {
					this.meta.current_page ++
					this.loadData()
				}
			},
			loadPreviousPage: function () {
				if(this.isProcesing) {
					return
				}
				if((this.meta.current_page > 1) && !this.isProcesing) {
					this.meta.current_page --
					this.loadData()
				}
			},
		}
	}
</script>
