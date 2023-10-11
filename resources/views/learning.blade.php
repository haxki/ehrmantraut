@extends('layouts.'.(empty(session('isAdmin')) ? 'main' : 'admin'))

@section('content')
<div class="content">
	<section id="inner_header"><h3>Учеба</h3></section>
	<img src="{{ asset("img/kid.jpg") }}" class="background" height="849" alt="">
	<section>
		<h1 style="margin: 30px 100px; font-size: 30px">Перечень изучаемых дисциплин с 1 по 4 семестр</h1>
		<h3>Севастопольский государственный университет</h3>
		<h3>Институт информационных технологий</h3>
		<table style="margin: 30px 100px; font-size: 20px">
			<tr><td colspan="9" class="center">ПЛАН УЧЕБНОГО ПРОЦЕССА</td></tr>
			<tr>	
				<th rowspan="2">№</th>
				<th rowspan="2">Дисциплина</th>
				<th rowspan="2">Кафедра</th>
				<th colspan="6">Всего часов</th>
			</tr>
			<tr>
				<th>Всего</th>
				<th>Ауд</th>
				<th>Лк</th>
				<th>Лб</th>
				<th>Пр</th>
				<th>СРС</th>
			</tr>
			<tr>
				<th>1</th>
				<td>Экология</td>
				<td class="center">БЖ</td>
				<td>54</td>
				<td>27</td>
				<td>18</td>
				<td>0</td>
				<td>9</td>
				<td>27</td>
			</tr>

            <tr>
				<th>2</th>
				<td>Высшая математика</td>
				<td class="center">ВМ</td>
				<td>540</td>
				<td>282</td>
				<td>141</td>
				<td>0</td>
				<td>141</td>
				<td>258</td>
			</tr>

			<tr>
				<th>3</th>
				<td>Русский язык и культура речи</td>
				<td class="center">НГиГ</td>
				<td>108</td>
				<td>54</td>
				<td>18</td>
				<td>0</td>
				<td>36</td>
				<td>54</td>
			</tr>
					
			<tr>
				<th>4</th>
				<td>Основы дискретной математики</td>
				<td class="center">ИС</td>
				<td>216</td>
				<td>139</td>
				<td>87</td>
				<td>0</td>
				<td>52</td>
				<td>77</td>
			</tr>	

			<tr>
    			<th>5</th>
				<td>Основы программирования и алгоритмические языки</td>
				<td class="center">ИС</td>
				<td>405</td>
				<td>210</td>
				<td>105</td>
				<td>87</td>
				<td>18</td>
				<td>195</td>
			</tr>	

			<tr>
				<th>6</th>
				<td>Основы экологии</td>
				<td class="center">ПЭОП</td>
				<td>54</td>
				<td>27</td>
	    		<td>18</td>
				<td>0</td>
				<td>9</td>
		    	<td>27</td>
			</tr>	

			<tr>
				<th>7</th>
				<td>Теория вероятностей и математическая статистика</td>
				<td class="center">ИС</td>
				<td>162</td>
				<td>72</td>
				<td>54</td>
				<td>18</td>
				<td>0</td>
				<td>90</td>
			</tr>	

			<tr>
				<th>8</th>
				<td>Физика</td>
				<td class="center">Физики</td>
				<td>324</td>
				<td>194</td>
				<td>106</td>
				<td>88</td>
				<td>0</td>
				<td>130</td>
			</tr>	

            <tr>
				<th>9</th>
				<td>Основы электротехники и электроники</td>
				<td class="center">ИС</td>
				<td>108</td>
				<td>72</td>
				<td>36</td>
				<td>18</td>
				<td>18</td>
				<td>36</td>
			</tr>	

			<tr>
				<th>10</th>
				<td>Численные методы в информатике</td>
				<td class="center">ИС</td>
				<td>189</td>
				<td>89</td>
				<td>36</td>
				<td>36</td>
				<td>17</td>
				<td>100</td>
			</tr>	
            
            <tr>
				<th>11</th>
				<td>Методы исследования операций</td>
			    <td class="center">ИС</td>
				<td>216</td>
				<td>104</td>
				<td>52</td>
				<td>35</td>
				<td>17</td>
				<td>112</td>
			</tr>	
		</table>
	</section>
</div>
@endsection

@section('extras')
	<link rel='stylesheet' type='text/css' href="{{ asset("css/table.css") }}">
@endsection