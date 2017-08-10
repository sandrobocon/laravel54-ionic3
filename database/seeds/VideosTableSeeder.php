<?php

use CodeFlix\Repositories\VideoRepository;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Collection;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Collection $series */
        $series = \CodeFlix\Models\Serie::all();
        $categories = \CodeFlix\Models\Category::all();
        $repository = app(VideoRepository::class);
        $collectionThumbs = $this->getThumbs();

        factory(\CodeFlix\Models\Video::class,2)
            ->create()
            ->each(function ($video) use(
                $series,$categories,$repository,$collectionThumbs
            ) {
                $repository->uploadThumb($video->id,$collectionThumbs->random());
                $video->categories()->attach($categories->random(rand(3,5))->pluck('id'));
                $num = rand(1,3);
                if($num%2==0){
                    //Serie com video
                    $serie = $series->random();
                    $video->serie_id = $serie->id;
                    $video->serie()->associate($serie);
                    $video->save();
                }
            });
    }

    protected function getThumbs()
    {
        return new \Illuminate\Support\Collection([
            new \Illuminate\Http\UploadedFile(
                storage_path('app/files/faker/thumbs/thumb_teste1.jpg'),
                'thumb_teste1.jpg'
            ),
            new \Illuminate\Http\UploadedFile(
                storage_path('app/files/faker/thumbs/thumb_teste2.jpg'),
                'thumb_teste2.jpg'
            ),
            new \Illuminate\Http\UploadedFile(
                storage_path('app/files/faker/thumbs/thumb_teste3.png'),
                'thumb_teste3.jpg'
            )
        ]);
    }
}
