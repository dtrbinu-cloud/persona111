<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $difficultyMap = [
            'grammar' => 'easy',
            'vocabulary' => 'medium',
            'context' => 'hard',
        ];
        $difficultyCounters = [
            'easy' => 0,
            'medium' => 0,
            'hard' => 0,
        ];

        $questions = [
            [
                'question' => 'What is the English word for "Buku"?',
                'option_a' => 'Pencil',
                'option_b' => 'Book',
                'option_c' => 'Eraser',
                'option_d' => 'Bag',
                'answer' => 'Book',
                'type' => 'vocabulary',
            ],
            [
                'question' => 'I ... a student.',
                'option_a' => 'is',
                'option_b' => 'am',
                'option_c' => 'are',
                'option_d' => 'do',
                'answer' => 'am',
                'type' => 'grammar',
            ],
            [
                'question' => 'She ... to school every day.',
                'option_a' => 'go',
                'option_b' => 'goes',
                'option_c' => 'going',
                'option_d' => 'gone',
                'answer' => 'goes',
                'type' => 'grammar',
            ],
            [
                'question' => 'What is the color of the sky on a sunny day?',
                'option_a' => 'Red',
                'option_b' => 'Green',
                'option_c' => 'Blue',
                'option_d' => 'Yellow',
                'answer' => 'Blue',
                'type' => 'vocabulary',
            ],
            [
                'question' => 'My father is a ... . He works in a hospital.',
                'option_a' => 'Teacher',
                'option_b' => 'Pilot',
                'option_c' => 'Doctor',
                'option_d' => 'Farmer',
                'answer' => 'Doctor',
                'type' => 'vocabulary',
            ],
            [
                'question' => 'We ... happy today.',
                'option_a' => 'am',
                'option_b' => 'is',
                'option_c' => 'are',
                'option_d' => 'was',
                'answer' => 'are',
                'type' => 'grammar',
            ],
            [
                'question' => 'What is the opposite of "Big"?',
                'option_a' => 'Tall',
                'option_b' => 'Short',
                'option_c' => 'Small',
                'option_d' => 'Large',
                'answer' => 'Small',
                'type' => 'vocabulary',
            ],
            [
                'question' => 'The cat is ... the table.',
                'option_a' => 'in',
                'option_b' => 'under',
                'option_c' => 'at',
                'option_d' => 'between',
                'answer' => 'under',
                'type' => 'grammar',
            ],
            [
                'question' => 'How do you say "Selamat Pagi" in English?',
                'option_a' => 'Good Morning',
                'option_b' => 'Good Afternoon',
                'option_c' => 'Good Evening',
                'option_d' => 'Goodbye',
                'answer' => 'Good Morning',
                'type' => 'context',
            ],
            [
                'question' => 'Apple, Banana, and Orange are kinds of ... .',
                'option_a' => 'Vegetables',
                'option_b' => 'Fruits',
                'option_c' => 'Drinks',
                'option_d' => 'Animals',
                'answer' => 'Fruits',
                'type' => 'vocabulary',
            ],
            [
                'question' => 'They ... football in the field.',
                'option_a' => 'play',
                'option_b' => 'plays',
                'option_c' => 'playing',
                'option_d' => 'played',
                'answer' => 'play',
                'type' => 'grammar',
            ],
            [
                'question' => 'I have two ... .',
                'option_a' => 'hand',
                'option_b' => 'hands',
                'option_c' => 'handes',
                'option_d' => 'handing',
                'answer' => 'hands',
                'type' => 'grammar',
            ],
            [
                'question' => 'What is the English word for "Keluarga"?',
                'option_a' => 'Friend',
                'option_b' => 'People',
                'option_c' => 'Family',
                'option_d' => 'Parent',
                'answer' => 'Family',
                'type' => 'vocabulary',
            ],
            [
                'question' => 'It is very hot. I want to ... some water.',
                'option_a' => 'eat',
                'option_b' => 'drink',
                'option_c' => 'sleep',
                'option_d' => 'read',
                'answer' => 'drink',
                'type' => 'context',
            ],
            [
                'question' => 'This is ... apple.',
                'option_a' => 'a',
                'option_b' => 'an',
                'option_c' => 'the',
                'option_d' => 'any',
                'answer' => 'an',
                'type' => 'grammar',
            ],
            [
                'question' => 'What is the capital city of Indonesia?',
                'option_a' => 'Surabaya',
                'option_b' => 'Bandung',
                'option_c' => 'Jakarta',
                'option_d' => 'Bali',
                'answer' => 'Jakarta',
                'type' => 'context',
            ],
            [
                'question' => 'Ten minus five is ... .',
                'option_a' => 'Five',
                'option_b' => 'Six',
                'option_c' => 'Four',
                'option_d' => 'Fifteen',
                'answer' => 'Five',
                'type' => 'grammar',
            ],
            [
                'question' => 'Where do you sleep?',
                'option_a' => 'Kitchen',
                'option_b' => 'Bathroom',
                'option_c' => 'Bedroom',
                'option_d' => 'Living room',
                'answer' => 'Bedroom',
                'type' => 'context',
            ],
            [
                'question' => 'I have a pet. It is a ... . It barks "Woof-woof".',
                'option_a' => 'Cat',
                'option_b' => 'Bird',
                'option_c' => 'Dog',
                'option_d' => 'Fish',
                'answer' => 'Dog',
                'type' => 'context',
            ],
            [
                'question' => 'A ... helps a doctor in the hospital.',
                'option_a' => 'Nurse',
                'option_b' => 'Chef',
                'option_c' => 'Driver',
                'option_d' => 'Postman',
                'answer' => 'Nurse',
                'type' => 'context',
            ],
        ];

        foreach ($questions as $question) {
            $difficulty = $difficultyMap[$question['type']] ?? 'easy';
            $difficultyCounters[$difficulty]++;
            $question['difficulty'] = $difficulty;
            $question['stage'] = (int) ceil($difficultyCounters[$difficulty] / 3);

            Question::updateOrCreate(
                ['question' => $question['question']],
                $question
            );
        }
    }
}
