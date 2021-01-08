<?php

namespace Tests\Feature;

use Tests\TestCase;

class EmailAnalysisTest extends TestCase
{
    public function testGetHeaders()
    {
        $mime = <<<EOD
            Delivered-To: tawanda@sendmarc.com
            Received: by 2002:a54:398c:0:0:0:0:0 with SMTP id v12csp4219390ecs;
                    Mon, 6 Jul 2020 01:33:09 -0700 (PDT)
            X-Google-Smtp-Source: ABdhPJx8WnECVl2nHRBg6JE16rsUp4sC6zgMuhjhibY0SFwAK7I6R9rXuKdDx8yei3wlOzoyZ1J9
            X-Received: by 2002:a1c:de07:: with SMTP id v7mr48851581wmg.56.1594024389446;
                    Mon, 06 Jul 2020 01:33:09 -0700 (PDT)
        EOD;

        $response = $this->post(route('email.analysis.headers'), ['mime' => $mime]);
        $response->assertSessionHasNoErrors();
    }
}
