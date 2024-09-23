<?php

namespace Vortextangent\Epeiros\Http;

interface RequestHandler
{
    public function handle(Request $request): Response;
}
