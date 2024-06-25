<template>
    <div>
        <div class="item">
            <input
                type="checkbox"
                class="check"
                @change="updateCheck()"
                v-model="item.completed"
            />
            <span :class="[item.completed ? 'completed' : '', 'itemText']">{{ item.content }}</span>
            <button @click="removeItem()" class="trashcan">
                <font-awesome-icon icon="trash"/>
            </button>
        </div>
    </div>
</template>

<script>

export default {
    props: ['item'],
    methods: {
        updateCheck () {
            axios.put('/item/' + this.item.id, {
                item: this.item
            })
            .then(response => {
                if (response.status == 200) {
                    this.$emit('itemChanged');
                }
            })
            .catch(error => {
                console.log(error)
            })
        },
        removeItem() {
            axios.delete('/item/' + this.item.id)
            .then(response => {
                if (response.status == 200) {
                    this.$emit('itemChanged');
                }
            })
            .catch(error => {
                console.log(error);
            })

        }
    }
}
</script>

<style>
.completed {
    text-decoration: line-through;
    color: #999999;
}
.itemText {
    width: 100%;
    margin-left: -160px;
}
.item {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 98%;
}
.trashcan {
    background: #e6e6e6;
    border: none;
    color: #FF0000;
    outline: none;
}
.trashcan:hover {
    -webkit-transform: scale(1.3);
    -ms-transform: scale(1.3);
    transform: scale(1.3);
    cursor: pointer;
    transition: all 0.1s;
}
.check:hover {
    -webkit-transform: scale(1.3);
    -ms-transform: scale(1.3);
    transform: scale(1.3);
    transition: all 0.1s;
}
.check {
    margin-left: -160px;
}
.check:hover {
    cursor: pointer;
}
</style>
