<template>
	<div class="card">
		<modal-search :title="title" :resource="resource" :url="url" :searchFields="searchFields"/>
		<div class="cart-title list-title d-flex  justify-content-between align-items-center">
			<h2 class="title">{{ title }}</h2>
		</div>
		<div class="btn-group btn-group float-right" role="group">
			<a class="btn" data-toggle="modal" data-target="#myModalSearch"><i class="fa fa-fw fa-search" /></a>
			<a class="btn" @click="loadPreviousPage"><i class="fa fa-chevron-left"></i></a>
			<span class="btn">{{ this.meta.current_page }}/{{ this.meta.last_page }}</span>
			<a class="btn" @click="loadNextPage"><i class="fa fa-chevron-right" /></a>
			<router-link class="btn" :to="`${url}/create`" :disabled="isProcessing">
				<span v-if="isProcessing" >
					<i  class="fa fa-spinner fa-spin" aria-hidden="true"></i>...
				</span>
				<span v-else >
					<i class="fa fa-fw fa-plus" ></i>
				</span>
			</router-link>
		</div>
		<div class="d-flex">
			<div class="list-group col-12">
				<div v-for="item in items" :key="item.id">
					<div class="list-group-item d-flex justify-content-between align-items-center">
						<router-link :to="`${url}/${item.id}`" class="d-flex col col-8">
							<div v-for="row in listRows" :key="row.id" :class="row.class">
								<div v-for="col in row.showFields" :key="col.field">
									<span class="text-left">{{ item[col.field] }}</span>
								</div>
							</div>
						</router-link>
						<div v-for="button in buttons" :key="button.id" class="col">
							<router-link class="btn btn-default" :to="`${url}/${item.id}/${button.path}`">
								<span>{{button.caption}}  </span><span class="badge badge-primary badge-pill">{{ item[button.field]}}</span>
							</router-link>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style lang="sass" scoped>
h2 		{ color: steel-blue; }
.list-title { background-color: whitesmoke;  border: 1px solid #ffdd57 }
.card	 	{ box-shadow: 0 2px 3px rgba(10, 10, 10, 0.1), 0 0 0 1px rgba(10, 10, 10, 0.1)} 	
</style>

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
			buttons: {
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
			var el = document.getElementById('navbar')
			if(el) {
				el.classList.remove('show')
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
