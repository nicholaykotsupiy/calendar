<template>
    <div>
        <table class="week" >
            <tr class="main">
                <th>день</th>
                <th>ПОНЕДЕЛЬНИК, 2</th>
                <th>ВТОРНИК, 3</th>
                <th>СРЕДА, 4</th>
                <th>ЧЕТВЕРГ, 5</th>
                <th>ПЯТНИЦА, 6</th>
                <th>СУББОТА, 7</th>
                <th>ВОСКРЕСЕНИЕ, 8</th>
            </tr>
            <tr>
                <td>1:00</td>
                <td></td>
                <td>
                    <div class="pink">Вселенная через...</div>
                </td>
                <td>
                    <div class="pink">Вселенная через...</div>
                </td>
                <td>
                    <div class="pink">Вселенная через...</div>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>2:00</td>
                <td></td>
                <td></td>
                <td>
                    <div class="orange">Основы покупки...</div>
                </td>
                <td>
                    <div class="orange">Основы покупки...</div>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>3:00</td>
                <td></td>
                <td></td>
                <td>
                    <div class="blue">Готовим на гриле</div>
                </td>
                <td></td>
                <td>
                    <div class="peach">Занимайся спортом...</div>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>4:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <div class="green">Вселенная через...</div>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <div class="brown">Вселенная через...</div>
                </td>
                <td></td>
            </tr>
        </table>
    </div>
</template>
<script>
export default {
    name: "Week"
}
</script>

<style>
 .main th{
     padding: 20px 5px;
     text-align: center;
}
table{
    width: 300px;
    border-collapse: collapse;
    border: 2px solid white;
    color: #B2B2B2;
    position: absolute;
    left: 26.2%;
    top: 200px;
    background: white;
}
td,th{
    padding: 3px;
    border: 1px solid #B2B2B2;
    text-align: left;
    white-space: nowrap;
}
td{
    font-size: 15px;
    padding: 5px 0;
}

.pink{
    border-left: 3px solid #C92A73;
    padding: 10px;
    color: #C92A73;
    background:rgba(201, 42, 115, 0.2);
}

.orange{
    border-left: 3px solid #FF9500;
    padding: 10px;
    color:#FF9500;
    background:rgba(255, 149, 0, 0.2);
}
.blue{
    border-left: 3px solid #19ADF8;
    padding: 10px;
    color: #19ADF8;
    background:rgba(25, 173, 248, 0.2);
}
.green{
    border-left: 3px solid #73DE4F;
    padding: 10px;
    color: #73DE4F;
    background:rgba(115, 222, 79, 0.2);
}
.peach{
    border-left: 3px solid #ffcc01;
    padding: 10px;
    color: #ffcc01;
    background:rgba(255, 204, 1, 0.2);
}
.brown{
    border-left: 3px solid #99572B;
    padding: 10px;
    color: #99572B;
    background:rgba(153, 87, 43, 0.2);
}

</style>
