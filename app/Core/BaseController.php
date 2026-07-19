<?php

namespace Core;

class BaseController
{
    protected function success($message, $data = [])
        {
                ApiResponse::success($message, $data);
                    }

                        protected function error($message, $code = 400)
                            {
                                    ApiResponse::error($message, $code);
                                        }
                                        }