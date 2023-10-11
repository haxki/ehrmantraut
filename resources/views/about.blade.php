@extends('layouts.'.(empty(session('isAdmin')) ? 'main' : 'admin'))

@section('content')
<div class="content">
	<section id="inner_header"><h3>Обо мне</h3></section>
	<img src="{{ asset("img/mike_about.jpg") }}" class="background" height="849" alt="">
	<section class="autobiography">
		<p>Знаешь, что коп боится больше всего? Больше чем пули, больше всего в жизни. Тюрьмы. 
		Попасть туда, где сидят посаженные тобой же. Если этим пригрозить копу, он станет опасен.</p>

		<p>Я встречал хороших преступников и плохих копов, грязных священников и порядочных воров. 
		Можно быть по одну сторону закона, а можно — по другую. Но если с кем-то договариваешься, держи своё слово. 
		Ты можешь вернуться домой со своими деньгами и больше так не делать. 
		Но ты взял то, что тебе не принадлежит, и выгодно это продал. 
		Теперь ты — преступник. Хороший, плохой — решать тебе.</p>

		<p>Правила парковки довольно простые, большинство запоминает с первого раза.</p>

        <p>То, что ты убил Джесси Джеймса, — еще не значит, что ты им стал.</p>

		<p>Все мы делаем выбор, и наш выбор выводит на путь. Порой выбор кажется простым, но и он выводит на путь. 
		Однажды захочешь сойти, но всё равно вернёшься на тот путь. 
		И вот наш путь привёл нас в пустыню и ко всему что там, случилось. 
		Туда, где мы с тобой сейчас. И ничего, ничего, тут не поделаешь.</p>

		<p>Все звучат как Мэрил Стрип с пушкой у виска.</p>

		<p>Есть люди... Люди, которые ждут меня дома. Они не знают что я делаю и не узнают. Они защищены. 
		Но я делаю то, что делаю, чтобы они могли жить лучше, буду ли я жить или здохну, лично мне по большому счёту без разницы, 
		если они будут обеспечены. И когда прийдёт моё время, я уйду, зная, что сделал для них все, что мог.</p>
	</section>
</div>
@endsection