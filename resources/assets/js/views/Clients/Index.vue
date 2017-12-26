<template>
	<div>
		<!-- Modal Search -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title">Search clients</h3>
					</div>
					<div class="modal-body">
						<input type="text" 
							class="form-control"
							placeholder="search" 
							v-model="searchToken"
							@keyup="loadSearch"
						>
						<div class="list-group">
							<div v-for="item in searchItems">
								<router-link data-dismiss="modal" class="list-group-item" :to="`/clients/${item.id}`">
									<div class="row">
										<div class="col col-xs-8">
											<strong class="text-left">{{item.name}}</strong>
										</div>
										<div class="col col-xs-4">
											{{item.dni}}
										</div>
									</div>
								</router-link>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<div class="col col-xs-7">
						<strong>Clients</strong>
					</div>
					<div class="col col-xs-5">
						<div class="pull-right">
							<button class="btn btn-primary" data-toggle="modal" data-target="#myModal">
								<i class="fa fa-fw fa-search" ></i>
							</button>
							<router-link class="btn btn-primary" :to="`/clients/create`" :disabled="isProcessing">
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
								{{client.birthday}}
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
				modalShow: false,
				currentSort: 'name',
				searchToken: '',
				searchItems: [],
				links: [],
				meta: {
					current_page: 1,
					last_page: 1
				}
			}
		},
		created() {
			this.loadData();
			// close menu
			var el = document.getElementById('app-navbar-collapse')
			if(el) {
				el.classList.remove('in')
			}
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
			loadSearch: function() {
				this.isProcessing = true
				console.log(this.searchToken)
				get(`/api/clients/search?q=${this.searchToken}`)
					.then((res) => {
						this.searchItems = res.data.data
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
