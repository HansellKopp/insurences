<template>
	<div>
		<modal-search :title="title" :resource="resource" :url="url" :searchFields="searchFields"/>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<div class="col col-xs-6">
						<strong>{{ title }}</strong>
					</div>
					<div class="col col-xs-6">
						<div class="pull-right">
							<button class="btn btn-primary" data-toggle="modal" data-target="#myModalSearch">
								<i class="fa fa-fw fa-search" ></i>
							</button>
							<router-link class="btn btn-primary" :to="`${url}/create`" :disabled="isProcessing">
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
				<div v-for="item in items" :key="item.id">
					<router-link class="list-group-item" :to="`${url}/${item.id}`">
						<div class="row" v-for="row in listRows" :key="row.id">
							<div v-for="col in row.showFields" :key="col.field">
								<div :class="col.class">
									<strong class="text-left">{{ item[col.field] }}</strong>
								</div>
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
	import { get } from '../helpers/api'
	import modalSearch from './modalSearch'

	export default {
		data() {
			return {
				items: [],
				isProcessing: false,
				currentSort: 'id',
				links: [],
				meta: {
					current_page: 1,
					last_page: 1
				}
			}
		},
		props: {
			title: {
			    type: String,
			    default: null
            },
			resource: {
			    type: String,
			    default: null
            },
			url: {
				type: String,
				default: null
			},
			searchFields: {
				type: Array,
				default: null
			},
			listRows: {
				type: Array,
				default: null
			},
			sortBy: {
				type: String,
				default: 'id'
			}
		},
		components: {
			modalSearch
		},
		created() {
			this.currentSort = this.$props.sortBy
			this.loadData()
			// close menu
			var el = document.getElementById('app-navbar-collapse')
			if(el) {
				el.classList.remove('in')
			}
		},
		computed: {
    		currentUrl: function () {
				return `/api/${this.$props.resource}?
				sort_by=${this.currentSort}&
				page=${this.meta.current_page}`
			}
		},
		methods: {
			loadData: function() {
				this.isProcessing = true
				get(this.currentUrl)
					.then((res) => {
						this.items = res.data.data
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
