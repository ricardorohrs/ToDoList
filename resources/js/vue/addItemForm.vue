<template>
    <div class="addItem">
        <input
            type="text"
            placeholder="Qual a sua tarefa?"
            v-model="item.content"/>
        <font-awesome-icon
            icon="plus-square"
            @click="addItem()"
            :class="[item.content ? 'active' : 'inactive', 'plus']"/>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            item: {
                content: ''
            }
        }
    },
    methods: {
        addItem() {
            if (!this.item.content) {
                return;
            }

            axios.post('/item/store/', {
                item: this.item
            }).then(response => {
                if (response.status == 201) {
                    this.item.content = "";
                    this.$emit('reloadList');
                }
            }).catch(error => {
                console.log(error);
            })
        }
    }
}
</script>

<style>
.addItem {
    display: flex;
    justify-content: center;
    align-items: center;
}
input {
    background: #f7f7f7;
    border: 0;
    outline: none;
    padding: 7px;
    margin-right: 10px;
    width: 100%;
}
.plus {
    font-size: 30px;
}
.plus:hover {
    -webkit-transform: scale(1.3);
    -ms-transform: scale(1.3);
    transform: scale(1.3);
    cursor: pointer;
    transition: all 0.1s;
}
.active {
    color: #00ce25;
}
.inactive {
    color: #999999;
}
</style>
