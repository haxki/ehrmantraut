<?php
    namespace App\Services;

    class TestService {
        private static array $answers = [
            'question1' => "совокупность элементов, обладающих некоторым признаком, свойством",
            'question2' => "Импликация",
            'question3' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consectetur dolores ".
                "distinctio consequatur sed praesentium iste ab adipisci molestiae, corrupti quidem autem ".
                "vitae cum beatae sequi, quaerat, maiores dignissimos fuga inventore. Totam nulla mollitia magni ipsa."
        ];

        public static function verify(array $answers) : array {
            $results = [];
            foreach (static::$answers as $key => $true_answer) {
                $results[$key] = $true_answer == $answers[$key];
            }
            return ['message' => static::makeMessage($results), 'results' => $results];
        }

        private static function makeMessage(array $answer_results) : string {
            $message = "Результаты прохождения теста:";
            $true_answers_count = 0;
            $answer_num = 1;
            foreach ($answer_results as $result) {
                if ($result) {
                    $true_answers_count++;
                }
                $truth = $result ? "верно" : "не верно";
                $message .= "\\n{$answer_num}. $truth";
                $answer_num++;
            }
            return $message;
        }

    }