import { beforeAll,expectTypeOf,test,describe, it, expect, vi } from 'vitest';
import axios from 'axios';
import { shallowMount } from '@vue/test-utils';

const BEFORE_ALL_TIMEOUT=30000; 

describe('testAjax', () => {
  let response,body;
  beforeAll(async()=>{
    response=await axios.get(
      "/testAjax"
    );
    body=response
  },BEFORE_ALL_TIMEOUT)
  test('test de ajax',()=>{
    expect(response.status).toBe(200)
  })
 



});
