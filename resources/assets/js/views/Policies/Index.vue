<template>
	<list-view
		title="Policies"
		url="/policies"
		resource="branches/152/policies"
		:searchFields="searchFields"
		:listRows="listRows"
		:sortBy="sortBy"
		:buttons="buttons"
	/>
</template>

<script>
import listView from '../../components/listView'

export default {
  	components: {
		listView
	},
	data() {
		return {
			sortBy: 'name',
			searchFields: [
				{ 'field': 'number', 'class': 'col-xs-5'},
			],
			listRows: [
					{ 
						'id': 1, 'showFields': [
							{ 'field': 'number', 'class': 'col-xs-4'},
						]
					},
					{ 
						'id': 2, 'showFields': [
							{ 'field': 'from', 'class': 'col-xs-4'},	
						]
					},
					{ 
						'id': 3, 'showFields': [
							{ 'field': 'to', 'class': 'col-xs-4'}	
						]
					}
			],
			buttons: [
				{ 'id': 1, 'caption': 'recepts', 'path': 'recept', 'field': 'recepts_count'}
			]
		}
	}
}
</script>
